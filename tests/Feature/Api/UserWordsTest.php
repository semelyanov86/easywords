<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Word;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

final class UserWordsTest extends TestCase
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

    #[Test]
    public function it_gets_user_words(): void
    {
        $this->markTestSkipped();
        $user = User::factory()->create();
        $words = Word::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(route('api.users.words.index', $user));

        $response->assertOk()->assertSee($words[0]->original);
    }

    #[Test]
    public function it_stores_the_user_words(): void
    {
        $this->markTestSkipped();
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

        $this->assertDatabaseHas('words', [
            'original' => $data['original'],
            'translated' => $data['translated'],
        ]);

        $response->assertStatus(201)->assertJsonFragment($data);

        $word = Word::latest('id')->first();

        $this->assertEquals($user->id, $word->user_id);
    }
}
