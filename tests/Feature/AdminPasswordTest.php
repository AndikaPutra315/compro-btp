<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminPasswordTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_change_password_page(): void
    {
        $response = $this->get(route('admin.password.edit'));
        $response->assertRedirect(route('login'));
    }

    public function test_admin_can_view_change_password_page(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.password.edit'));
        $response->assertStatus(200);
        $response->assertSee('Ganti Password');
        $response->assertSee('Password Saat Ini');
        $response->assertSee('Password Baru');
    }

    public function test_admin_cannot_change_password_with_incorrect_current_password(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('old-password-123'),
        ]);

        $response = $this->actingAs($user)->put(route('admin.password.update'), [
            'current_password' => 'wrong-current-password',
            'password' => 'new-secret-password-123',
            'password_confirmation' => 'new-secret-password-123',
        ]);

        $response->assertSessionHasErrors('current_password');
        $this->assertTrue(Hash::check('old-password-123', $user->fresh()->password));
    }

    public function test_admin_cannot_change_password_with_mismatched_confirmation(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('old-password-123'),
        ]);

        $response = $this->actingAs($user)->put(route('admin.password.update'), [
            'current_password' => 'old-password-123',
            'password' => 'new-secret-password-123',
            'password_confirmation' => 'different-confirmation',
        ]);

        $response->assertSessionHasErrors('password');
        $this->assertTrue(Hash::check('old-password-123', $user->fresh()->password));
    }

    public function test_admin_can_successfully_change_password(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('old-password-123'),
        ]);

        $response = $this->actingAs($user)->put(route('admin.password.update'), [
            'current_password' => 'old-password-123',
            'password' => 'new-secret-password-123',
            'password_confirmation' => 'new-secret-password-123',
        ]);

        $response->assertRedirect(route('admin.password.edit'));
        $response->assertSessionHas('success');
        $this->assertTrue(Hash::check('new-secret-password-123', $user->fresh()->password));
    }
}
