<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Word;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WordTest extends TestCase
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
    public function it_gets_words_list()
    {
        $words = Word::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.words.index'));

        $response->assertOk()->assertSee($words[0]->original);
    }

    /**
     * @test
     */
    public function it_stores_the_word()
    {
        $data = Word::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.words.store'), $data);

        $this->assertDatabaseHas('words', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_word()
    {
        $word = Word::factory()->create();

        $user = User::factory()->create();

        $data = [
            'original' => $this->faker->text(255),
            'translated' => $this->faker->text(255),
            'done_at' => $this->faker->dateTime,
            'starred' => $this->faker->boolean,
            'language' => $this->faker->text(5),
            'views' => 0,
            'user_id' => $user->id,
        ];

        $response = $this->putJson(route('api.words.update', $word), $data);

        $data['id'] = $word->id;

        $this->assertDatabaseHas('words', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_word()
    {
        $word = Word::factory()->create();

        $response = $this->deleteJson(route('api.words.destroy', $word));

        $this->assertDeleted($word);

        $response->assertNoContent();
    }
}
