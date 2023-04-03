<?php

namespace Tests\Feature\Api;

use PHPUnit\Framework\Attributes\Test;
use App\Models\User;
use App\Models\Word;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class StatisticsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();

        $this->generateData($user);
    }

    protected function generateData(User $user): void
    {
        $user2 = User::factory()->create(['email' => 'user@user.com']);
        Word::factory()->createOne([
            'user_id' => $user->id,
            'starred' => true,
            'done_at' => null,
            'views' => 5,
        ]);
        Word::factory()->create([
            'user_id' => $user->id,
            'starred' => false,
            'done_at' => Carbon::now(),
            'views' => 10,
        ]);
        Word::factory()->create([
            'user_id' => $user->id,
            'starred' => false,
            'done_at' => null,
            'views' => 0,
        ]);
        Word::factory()->create([
            'user_id' => $user2->id,
            'starred' => true,
            'done_at' => null,
            'views' => 8,
        ]);
    }

    #[Test]
    public function it_gets_stat_result(): void
    {
        $response = $this->getJson(route('statistics.index'));

        $response->assertOk()->assertJson([
            'all' => 3,
            'starred' => 1,
            'not_dones' => 2,
            'dones' => 1,
            'total_views' => 15,
            'users_count' => 2,
            'most_viewed' => [],
            'added_today' => [],
            'updated_this_month' => 3,
            'updated_today' => 0,
        ]);
    }
}
