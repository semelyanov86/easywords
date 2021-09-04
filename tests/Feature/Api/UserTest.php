<?php

namespace Tests\Feature\Api;

use App\Models\User;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_users_list()
    {
        $users = User::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('users.index'));

        $response->assertOk()->assertSee($users[0]->name);
    }

    /**
     * @test
     */
    public function it_gets_short_list()
    {
        $users = User::factory()
            ->count(3)
            ->create();

        $response = $this->getJson(route('users.short'));

        $response->assertOk()->assertSee($users[0]->name);
    }
}
