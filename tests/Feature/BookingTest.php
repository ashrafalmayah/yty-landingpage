<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingTest extends TestCase
{
    use RefreshDatabase;

    public function test_landing_page_can_be_rendered(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('مساحة عملك المكتبية');
    }

    public function test_user_can_submit_booking_form(): void
    {
        $bookingData = [
            'name' => 'أحمد علي',
            'email' => 'ahmed@example.com',
            'phone' => '+967 770 123 456',
            'notes' => 'أبحث عن مكتب خاص شهر كامل',
        ];

        $response = $this->post('/booking', $bookingData);

        $response->assertStatus(302);
        $response->assertSessionHas('success_name', 'أحمد علي');

        $this->assertDatabaseHas('bookings', [
            'name' => 'أحمد علي',
            'email' => 'ahmed@example.com',
            'phone' => '+967770123456',
        ]);
    }

    public function test_phone_number_is_normalized_to_e164_format(): void
    {
        $bookingData = [
            'name' => 'سارة محمد',
            'email' => 'sara@example.com',
            'phone' => '0770123456',
            'notes' => 'اختبار تحويل الرقم المحلي',
        ];

        $response = $this->post('/booking', $bookingData);

        $response->assertStatus(302);
        $this->assertDatabaseHas('bookings', [
            'email' => 'sara@example.com',
            'phone' => '+967770123456',
        ]);
    }

    public function test_booking_fails_for_non_yemeni_phone(): void
    {
        $bookingData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '+1 555 123 4567',
            'notes' => 'Non-Yemeni number',
        ];

        $response = $this->post('/booking', $bookingData);

        $response->assertSessionHasErrors(['phone']);
        $this->assertDatabaseMissing('bookings', [
            'email' => 'john@example.com',
        ]);
    }
}
