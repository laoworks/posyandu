<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_users_can_authenticate_using_the_login_screen(): void
    {
        $user = User::factory()->create();
        Role::create(['name' => 'kader']);
        $user->assignRole('kader');

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('admin.dashboard', absolute: false));
    }

    public function test_bidan_users_are_redirected_to_their_dashboard_after_login(): void
    {
        $user = User::factory()->create();
        Role::create(['name' => 'bidan_desa']);
        $user->assignRole('bidan_desa');

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('bidan.dashboard', absolute: false));
    }

    public function test_orang_tua_users_are_redirected_to_their_dashboard_after_login(): void
    {
        $user = User::factory()->create();
        Role::create(['name' => 'orang_tua']);
        $user->assignRole('orang_tua');

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('orangtua.dashboard', absolute: false));
    }

    public function test_system_bidan_account_is_normalized_to_bidan_role_on_login(): void
    {
        Role::create(['name' => 'bidan_desa']);
        Role::create(['name' => 'orang_tua']);

        $user = User::factory()->create([
            'email' => 'bidan@posyandu.com',
        ]);

        $user->assignRole('orang_tua');

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('bidan.dashboard', absolute: false));
        $this->assertSame(['bidan_desa'], $user->fresh()->getRoleNames()->values()->all());
    }

    public function test_users_without_valid_roles_are_logged_out_after_login(): void
    {
        $user = User::factory()->create();

        $response = $this->from('/login')->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertGuest();
        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');
    }

    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }

    public function test_users_can_logout(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/logout');

        $this->assertGuest();
        $response->assertRedirect('/');
    }
}
