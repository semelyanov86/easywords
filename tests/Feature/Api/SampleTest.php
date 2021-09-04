<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Sample;

use App\Models\Word;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SampleTest extends TestCase
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
    public function it_gets_samples_list(): void
    {
        $samples = Sample::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.samples.index', ['language' => $samples[0]->language]));

        $response->assertOk()->assertSee($samples[0]->original);
    }

    /**
     * @test
     */
    public function it_can_export_samples(): void
    {
        $user = User::where('email', 'admin@admin.com')->firstOrFail();
        $user2 = User::factory()->createOne(['email' => 'user@user.com']);
        Word::factory()->createOne([
            'user_id' => $user2->id
        ]);

        $samples = Sample::factory()
            ->count(5)
            ->create([
                'language' => 'DE'
            ]);

        $response = $this->getJson(route('api.samples.export', ['language' => 'DE']));

        $response->assertNoContent();

        $this->assertDatabaseCount('words', 6);

        $this->assertCount(5, Word::where('user_id', $user->id)->where('language', 'DE')->get());
    }
}
