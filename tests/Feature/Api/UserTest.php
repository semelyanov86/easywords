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
    public function it_stores_the_user()
    {
        $data = User::factory()
            ->make()
            ->toArray();
        $data['password'] = \Str::random('8');

        $response = $this->postJson('api/users', $data);

        unset($data['password']);
        unset($data['email_verified_at']);
        unset($data['current_team_id']);
        unset($data['profile_photo_path']);

        $this->assertDatabaseHas('users', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_user(): void
    {
        $user = User::factory()->create();

        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
        ];

        $data['password'] = \Str::random('8');

        $response = $this->putJson('api/users/' . $user->id, $data);

        unset($data['password']);
        unset($data['email_verified_at']);
        unset($data['current_team_id']);
        unset($data['profile_photo_path']);

        $data['id'] = $user->id;

        $this->assertDatabaseHas('users', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_user(): void
    {
        $user = User::factory()->create();

        $response = $this->deleteJson('api/users/' . $user->id);

        $this->assertSoftDeleted($user);

        $response->assertNoContent();
    }
}
