<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Word;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

final class WordControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    #[Test]
    public function it_displays_index_view_with_words(): void
    {
        $words = Word::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('words.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.words.index')
            ->assertViewHas('words');
    }

    #[Test]
    public function it_displays_create_view_for_word(): void
    {
        $response = $this->get(route('words.create'));

        $response->assertOk()->assertViewIs('app.words.create');
    }

    #[Test]
    public function it_stores_the_word(): void
    {
        $data = Word::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('words.store'), $data);
        $data['user_id'] = (string) $data['user_id'];
        $data['views'] = (string) $data['views'];
        unset($data['done_at']);

        $this->assertDatabaseHas('words', $data);

        $word = Word::latest('id')->first();

        $response->assertRedirect(route('words.edit', $word));
    }

    #[Test]
    public function it_displays_show_view_for_word(): void
    {
        $word = Word::factory()->create();

        $response = $this->get(route('words.show', $word));

        $response
            ->assertOk()
            ->assertViewIs('app.words.show')
            ->assertViewHas('word');
    }

    #[Test]
    public function it_displays_edit_view_for_word(): void
    {
        $word = Word::factory()->create();

        $response = $this->get(route('words.edit', $word));

        $response
            ->assertOk()
            ->assertViewIs('app.words.edit')
            ->assertViewHas('word');
    }

    #[Test]
    public function it_updates_the_word(): void
    {
        $word = Word::factory()->create();

        $user = User::factory()->create();

        $data = [
            'original' => $this->faker->text(255),
            'translated' => $this->faker->text(255),
            'done_at' => $this->faker->dateTime()->format('Y-m-d H:i:s'),
            'starred' => $this->faker->boolean(),
            'language' => $this->faker->text(5),
            'views' => 0,
            'user_id' => $user->id,
        ];

        $response = $this->put(route('words.update', $word), $data);

        $data['id'] = $word->id;

        $this->assertDatabaseHas('words', $data);

        $response->assertRedirect(route('words.edit', $word));
    }

    #[Test]
    public function it_deletes_the_word(): void
    {
        $word = Word::factory()->create();

        $response = $this->delete(route('words.destroy', $word));

        $response->assertRedirect(route('words.index'));

        $this->assertModelMissing($word);
    }
}
