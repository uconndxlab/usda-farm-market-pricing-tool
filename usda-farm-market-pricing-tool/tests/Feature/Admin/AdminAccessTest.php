<?php

namespace Tests\Feature\Admin;

use App\Models\PriceEntry;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_non_admin_users_cannot_access_admin_routes(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get(route('admin.index'))->assertForbidden();
        $this->actingAs($user)->get(route('admin.users'))->assertForbidden();
        $this->actingAs($user)->get(route('admin.entries'))->assertForbidden();
    }

    public function test_admin_can_view_all_users_and_entries(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin@example.com',
        ]);
        $admin->forceFill(['is_admin' => true])->save();

        $user = User::factory()->create([
            'name' => 'Market User',
            'email' => 'market@example.com',
        ]);

        PriceEntry::create([
            'user_id' => $user->id,
            'town' => 'Storrs',
            'farmers_market' => 'Saturday Market',
            'crop' => 'Apples',
            'variety' => 'Gala',
            'production_method' => 'Organic',
            'sales_method' => 'Direct To Consumer',
            'unit' => 'Pound',
            'price_per_unit' => 3.50,
            'date_collected' => '2026-09-08',
        ]);

        $this->actingAs($admin)->get(route('admin.index'))
            ->assertOk()
            ->assertSee('Market User')
            ->assertSee('Apples');

        $this->actingAs($admin)->get(route('admin.users'))
            ->assertOk()
            ->assertSee('market@example.com');

        $this->actingAs($admin)->get(route('admin.entries'))
            ->assertOk()
            ->assertSee('Saturday Market')
            ->assertSee('market@example.com');
    }
}
