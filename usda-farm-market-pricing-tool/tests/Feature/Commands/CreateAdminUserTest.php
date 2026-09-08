<?php

namespace Tests\Feature\Commands;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateAdminUserTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_creates_a_verified_admin_user(): void
    {
        $this->artisan('admin:create', [
            '--name' => 'Admin User',
            '--email' => 'admin@example.com',
        ])
            ->expectsQuestion('Password', 'secret-password')
            ->expectsQuestion('Confirm password', 'secret-password')
            ->assertExitCode(0);

        $this->assertDatabaseHas('users', [
            'email' => 'admin@example.com',
            'is_admin' => true,
        ]);

        $this->assertNotNull(User::where('email', 'admin@example.com')->first()->email_verified_at);
    }

    public function test_it_promotes_an_existing_user_without_changing_their_password(): void
    {
        $user = User::factory()->create([
            'email' => 'existing@example.com',
            'password' => 'existing-password',
        ]);

        $this->artisan('admin:create', [
            '--name' => 'Ignored Name',
            '--email' => $user->email,
        ])->assertExitCode(0);

        $this->assertTrue($user->fresh()->is_admin);
        $this->assertTrue(password_verify('existing-password', $user->fresh()->password));
    }
}