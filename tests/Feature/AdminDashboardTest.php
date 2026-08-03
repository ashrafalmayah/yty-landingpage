<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_admin_dashboard(): void
    {
        $response = $this->get('/admin/dashboard');

        $response->assertRedirect('/login');
    }

    public function test_admin_can_login_and_access_dashboard(): void
    {
        $user = User::factory()->create([
            'email' => 'admin@yty-incubator.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/login', [
            'email' => 'admin@yty-incubator.com',
            'password' => 'password',
        ]);

        $response->assertRedirect('/admin/dashboard');
        $this->assertAuthenticatedAs($user);

        $dashboardResponse = $this->get('/admin/dashboard');
        $dashboardResponse->assertStatus(200);
        $dashboardResponse->assertSee('لوحة تحكم طلبات YTY');
    }

    public function test_admin_can_update_booking_status(): void
    {
        $user = User::factory()->create();
        $booking = Booking::create([
            'name' => 'محمد خالد',
            'email' => 'mohamed@example.com',
            'phone' => '+967 771 234 567',
            'notes' => 'مكتب مشترك',
            'status' => 'pending',
        ]);

        $response = $this->actingAs($user)->patch("/admin/bookings/{$booking->id}/status", [
            'status' => 'contacted',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('bookings', [
            'id' => $booking->id,
            'status' => 'contacted',
        ]);
    }
}
