<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthAndRoleTest extends TestCase
{
    use RefreshDatabase;

    public function test_register_creates_user_role_and_redirects_to_user_dashboard(): void
    {
        $response = $this->post(route('register.store'), [
            'name' => 'User Baru',
            'email' => 'baru@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect(route('user.dashboard'));

        $this->assertDatabaseHas('users', [
            'email' => 'baru@example.com',
            'role' => 'user',
        ]);

        $this->assertDatabaseHas('pelanggan', [
            'nama_pelanggan' => 'User Baru',
            'email' => 'baru@example.com',
        ]);
    }

    public function test_non_admin_user_cannot_open_admin_dashboard(): void
    {
        $user = User::factory()->create(['role' => User::ROLE_USER]);

        $response = $this->actingAs($user)->get(route('admin.dashboard'));

        $response->assertForbidden();
    }

    public function test_admin_user_can_open_admin_dashboard(): void
    {
        $admin = User::factory()->create(['role' => User::ROLE_ADMIN]);

        $response = $this->actingAs($admin)->get(route('admin.dashboard'));

        $response->assertOk();
    }

    public function test_ceo_only_opens_sales_report_area(): void
    {
        $ceo = User::factory()->create(['role' => User::ROLE_CEO]);

        $this->actingAs($ceo)
            ->get(route('dashboard'))
            ->assertRedirect(route('ceo.laporan.penjualan'));

        $this->actingAs($ceo)
            ->get(route('ceo.dashboard'))
            ->assertRedirect(route('ceo.laporan.penjualan'));

        $this->actingAs($ceo)
            ->get(route('ceo.laporan.penjualan'))
            ->assertOk()
            ->assertSee('Pelanggan yang buka kredit')
            ->assertSee('Margin Keuntungan')
            ->assertSee('Margin Penjualan');

        $this->actingAs($ceo)
            ->get('/ceo/kredit')
            ->assertNotFound();
    }
}
