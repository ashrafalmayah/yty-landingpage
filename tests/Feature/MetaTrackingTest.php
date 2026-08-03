<?php

namespace Tests\Feature;

use App\Helpers\MetaHelper;
use App\Jobs\SendMetaEventJob;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class MetaTrackingTest extends TestCase
{
    use RefreshDatabase;

    public function test_booking_submission_dispatches_meta_lead_job_and_flashes_event(): void
    {
        Queue::fake();

        $bookingData = [
            'name' => 'محمد سعيد',
            'email' => 'm.said@example.com',
            'phone' => '+967 771 987 654',
            'notes' => 'مكتب مشترك',
        ];

        $response = $this->post('/booking', $bookingData);

        $response->assertStatus(302);
        $response->assertSessionHas('success_name', 'محمد سعيد');
        $response->assertSessionHas('meta_events');

        Queue::assertPushed(SendMetaEventJob::class, function ($job) {
            $reflection = new \ReflectionClass($job);
            
            $eventNameProp = $reflection->getProperty('eventName');
            $eventNameProp->setAccessible(true);
            $eventName = $eventNameProp->getValue($job);

            $userDataProp = $reflection->getProperty('userData');
            $userDataProp->setAccessible(true);
            $userData = $userDataProp->getValue($job);

            return $eventName === 'Lead'
                && isset($userData['em'][0])
                && $userData['em'][0] === hash('sha256', 'm.said@example.com')
                && isset($userData['ph'][0])
                && $userData['ph'][0] === hash('sha256', '967771987654');
        });
    }

    public function test_meta_helper_hashes_pii_user_data_correctly(): void
    {
        $input = [
            'name' => 'John Doe',
            'email' => 'TEST@Example.com ',
            'phone' => '+1 (555) 123-4567',
        ];

        $userData = MetaHelper::getUserData(null, $input);

        $this->assertEquals(hash('sha256', 'test@example.com'), $userData['em'][0]);
        $this->assertEquals(hash('sha256', '15551234567'), $userData['ph'][0]);
        $this->assertEquals(hash('sha256', 'john'), $userData['fn'][0]);
        $this->assertEquals(hash('sha256', 'doe'), $userData['ln'][0]);
        $this->assertEquals(hash('sha256', 'sanaa'), $userData['ct'][0]);
        $this->assertEquals(hash('sha256', 'sa'), $userData['st'][0]);
        $this->assertEquals(hash('sha256', 'ye'), $userData['country'][0]);
        $this->assertEquals(hash('sha256', '15000'), $userData['zp'][0]);
        $this->assertNotEmpty($userData['external_id']);
    }

    public function test_landing_page_dispatches_page_view_job_when_pixel_id_configured(): void
    {
        Queue::fake();

        config(['services.meta.pixel_id' => '1234567890']);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('fbq(\'init\', \'1234567890\'', false);

        Queue::assertPushed(SendMetaEventJob::class, function ($job) {
            $reflection = new \ReflectionClass($job);
            
            $eventNameProp = $reflection->getProperty('eventName');
            $eventNameProp->setAccessible(true);
            $eventName = $eventNameProp->getValue($job);

            return $eventName === 'PageView';
        });
    }

    public function test_contact_endpoint_dispatches_meta_contact_job(): void
    {
        Queue::fake();

        $response = $this->postJson('/meta/contact', ['channel' => 'WhatsApp']);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        Queue::assertPushed(SendMetaEventJob::class, function ($job) {
            $reflection = new \ReflectionClass($job);
            
            $eventNameProp = $reflection->getProperty('eventName');
            $eventNameProp->setAccessible(true);
            $eventName = $eventNameProp->getValue($job);

            $customDataProp = $reflection->getProperty('customData');
            $customDataProp->setAccessible(true);
            $customData = $customDataProp->getValue($job);

            return $eventName === 'Contact' && ($customData['content_name'] ?? '') === 'WhatsApp';
        });
    }

    public function test_persisted_user_data_is_reused_in_subsequent_events(): void
    {
        Queue::fake();

        $bookingResponse = $this->post('/booking', [
            'name' => 'علي سالم',
            'email' => 'ali.salem@example.com',
            'phone' => '+967 772 111 222',
        ]);

        $this->withSession($bookingResponse->getSession()->all())
             ->postJson('/meta/contact', ['channel' => 'WhatsApp']);

        Queue::assertPushed(SendMetaEventJob::class, function ($job) {
            $reflection = new \ReflectionClass($job);
            
            $eventNameProp = $reflection->getProperty('eventName');
            $eventNameProp->setAccessible(true);
            $eventName = $eventNameProp->getValue($job);

            $userDataProp = $reflection->getProperty('userData');
            $userDataProp->setAccessible(true);
            $userData = $userDataProp->getValue($job);

            if ($eventName !== 'Contact') {
                return false;
            }

            return isset($userData['em'][0])
                && $userData['em'][0] === hash('sha256', 'ali.salem@example.com')
                && isset($userData['ph'][0])
                && $userData['ph'][0] === hash('sha256', '967772111222');
        });
    }
}
