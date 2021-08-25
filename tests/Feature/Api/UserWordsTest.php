<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Word;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserWordsTest extends TestCase
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
    public function it_gets_user_words()
    {
        $user = User::factory()->create();
        $words = Word::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(route('api.users.words.index', $user));

        $response->assertOk()->assertSee($words[0]->original);
    }

    /**
     * @test
     */
    public function it_stores_the_user_words()
    {
        $user = User::factory()->create();
        $data = Word::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.words.store', $user),
            $data
        );

        $this->assertDatabaseHas('words', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $word = Word::latest('id')->first();

        $this->assertEquals($user->id, $word->user_id);
    }
}
