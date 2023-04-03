<?php

namespace Tests\Feature\Controllers;

use PHPUnit\Framework\Attributes\Test;
use App\Models\Sample;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SampleControllerTest extends TestCase
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
    public function it_displays_index_view_with_samples(): void
    {
        $samples = Sample::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('samples.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.samples.index')
            ->assertViewHas('samples');
    }

    #[Test]
    public function it_displays_create_view_for_sample(): void
    {
        $response = $this->get(route('samples.create'));

        $response->assertOk()->assertViewIs('app.samples.create');
    }

    #[Test]
    public function it_stores_the_sample(): void
    {
        $data = Sample::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('samples.store'), $data);

        $this->assertDatabaseHas('samples', $data);

        $sample = Sample::latest('id')->first();

        $response->assertRedirect(route('samples.edit', $sample));
    }

    #[Test]
    public function it_displays_show_view_for_sample(): void
    {
        $sample = Sample::factory()->create();

        $response = $this->get(route('samples.show', $sample));

        $response
            ->assertOk()
            ->assertViewIs('app.samples.show')
            ->assertViewHas('sample');
    }

    #[Test]
    public function it_displays_edit_view_for_sample(): void
    {
        $sample = Sample::factory()->create();

        $response = $this->get(route('samples.edit', $sample));

        $response
            ->assertOk()
            ->assertViewIs('app.samples.edit')
            ->assertViewHas('sample');
    }

    #[Test]
    public function it_updates_the_sample(): void
    {
        $sample = Sample::factory()->create();

        $data = [
            'original' => $this->faker->text(255),
            'translated' => $this->faker->text(255),
            'language' => $this->faker->text(5),
        ];

        $response = $this->put(route('samples.update', $sample), $data);

        $data['id'] = $sample->id;

        $this->assertDatabaseHas('samples', $data);

        $response->assertRedirect(route('samples.edit', $sample));
    }

    #[Test]
    public function it_deletes_the_sample(): void
    {
        $sample = Sample::factory()->create();

        $response = $this->delete(route('samples.destroy', $sample));

        $response->assertRedirect(route('samples.index'));

        $this->assertModelMissing($sample);
    }
}
