<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Word;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

final class WordTest extends TestCase
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
    public function it_gets_words_list(): void
    {
        $words = Word::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('words.index'));

        $response->assertOk()->assertSee($words[0]->original);
    }

    #[Test]
    public function it_gets_known_words(): void
    {
        $words = Word::factory()
            ->count(5)
            ->create();
        $wordsKnown = Word::factory()
            ->count(2)
            ->create([
                'done_at' => now(),
            ]);

        $response = $this->getJson(route('api.words.listknown'));

        $response->assertOk()->assertSee($wordsKnown[0]->original)->assertSee($wordsKnown[1]->original);
    }

    #[Test]
    public function it_stores_the_word(): void
    {
        $data = Word::factory()
            ->make()
            ->toArray();

        unset($data['user_id']);
        $data['done_at'] = null;

        $response = $this->postJson('api/words', $data);

        $this->assertDatabaseHas('words', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    #[Test]
    public function it_show_the_word(): void
    {
        $data = Word::factory()
            ->create()
            ->toArray();

        unset($data['updated_at']);
        $data['user_id'] = $data['user_id'];
        $data['views'] = $data['views'];

        $response = $this->getJson('api/words/'.$data['id']);

        $response->assertStatus(200)->assertJsonFragment($data);
    }

    #[Test]
    public function it_updates_the_word(): void
    {
        $this->markTestSkipped('Functionality not implemented');

        $word = Word::factory()->create();

        $user = User::factory()->create();

        $data = [
            'original' => $this->faker->text(100),
            'translated' => $this->faker->text(100),
            'done_at' => null,
            'starred' => $this->faker->boolean(),
            'language' => 'RU',
            'views' => 2,
            'user_id' => $user->id,
        ];

        $response = $this->putJson(route('words.update', $word), $data);

        $data['id'] = $word->id;

        $this->assertDatabaseHas('words', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    #[Test]
    public function it_deletes_the_word(): void
    {
        $word = Word::factory()->create();

        $response = $this->deleteJson('api/words/'.$word->id);

        $this->assertModelMissing($word);

        $response->assertNoContent();
    }

    #[Test]
    public function it_marks_as_viewed(): void
    {
        $word = Word::factory()->create([
            'views' => 0,
        ]);
        $response = $this->getJson(route('api.words.viewed', $word->id));
        $response->assertOk();
        $word->refresh();
        $this->assertEquals(1, $word->views);
    }

    #[Test]
    public function it_marks_as_known(): void
    {
        $word = Word::factory()->create([
            'done_at' => null,
        ]);
        $response = $this->getJson(route('api.words.known', [
            'word' => $word->id,
            'value' => 1,
        ]));
        $response->assertOk();
        $word->refresh();
        $this->assertNotNull($word->done_at);
    }

    #[Test]
    public function it_marks_as_unknown(): void
    {
        $word = Word::factory()->create([
            'done_at' => null,
        ]);
        $response = $this->getJson(route('api.words.known', [
            'word' => $word->id,
            'value' => 0,
        ]));
        $response->assertOk();
        $word->refresh();
        $this->assertNull($word->done_at);
    }

    #[Test]
    public function it_marks_as_starred(): void
    {
        $word = Word::factory()->create([
            'starred' => false,
        ]);
        $response = $this->getJson(route('api.words.starred', [
            'word' => $word->id,
            'value' => 1,
        ]));
        $response->assertOk();
        $word->refresh();
        $this->assertTrue($word->starred);
    }

    #[Test]
    public function it_marks_as_unstarred(): void
    {
        $word = Word::factory()->create([
            'starred' => true,
        ]);
        $response = $this->getJson(route('api.words.starred', [
            'word' => $word->id,
            'value' => 0,
        ]));
        $response->assertOk();
        $word->refresh();
        $this->assertFalse($word->starred);
    }

    #[Test]
    public function it_share_word_to_different_user(): void
    {
        $user1 = User::factory()->createOne();
        $user2 = User::factory()->createOne();
        $word = Word::factory()->createOne([
            'user_id' => $user1->id,
        ]);
        $response = $this->getJson(route('api.words.share', [
            'word' => $word->id,
            'user' => $user2->id,
        ]));
        $response->assertStatus(201);
        $word->refresh();
        $this->assertDatabaseHas('words', [
            'original' => $word->original,
            'translated' => $word->translated,
            'user_id' => $user2->id,
        ]);
    }
}
