<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Booking;

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
            'phone' => '+967 770 123 456',
        ]);
    }
}
