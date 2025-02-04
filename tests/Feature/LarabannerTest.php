<?php

namespace effina\Larabanner\Tests\Unit;

use effina\Larabanner\Tests\TestCase;
use effina\Larabanner\Models\Larabanner;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LarabannerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_determines_if_banner_is_displayable_based_on_dates()
    {
        $banner = Larabanner::factory()->create([
            'display_start_date' => now()->subDay(),
            'display_stop_date' => now()->addDay(),
        ]);

        $this->assertTrue($banner->isDisplayable());

        $expiredBanner = Larabanner::factory()->create([
            'display_start_date' => now()->subDays(2),
            'display_stop_date' => now()->subDay(),
        ]);

        $this->assertFalse($expiredBanner->isDisplayable());

        $futureBanner = Larabanner::factory()->create([
            'display_start_date' => now()->addDay(),
        ]);

        $this->assertFalse($futureBanner->isDisplayable());
    }

    /** @test */
    public function it_determines_if_banner_is_displayable_based_on_days()
    {
        $currentDay = strtolower(date('D'));
        $nextDay = strtolower(date('D', strtotime('tomorrow')));

        $banner = Larabanner::factory()->create([
            'display_start_date' => now()->subDay(),
            'display_days' => [$currentDay],
        ]);

        $this->assertTrue($banner->isDisplayable());

        $banner->display_days = [$nextDay];
        $banner->save();

        $this->assertFalse($banner->isDisplayable());
    }

    /** @test */
    public function it_can_get_remaining_time()
    {
        $banner = Larabanner::factory()->create([
            'display_start_date' => now(),
            'display_stop_date' => now()->addDays(5),
        ]);

        $this->assertStringContainsString('days', $banner->getRemainingTime());

        $expiredBanner = Larabanner::factory()->create([
            'display_start_date' => now()->subDays(2),
            'display_stop_date' => now()->subDay(),
        ]);

        $this->assertEquals('Expired', $expiredBanner->getRemainingTime());

        $neverEndingBanner = Larabanner::factory()->create([
            'display_start_date' => now(),
            'display_stop_date' => null,
        ]);

        $this->assertNull($neverEndingBanner->getRemainingTime());
    }

    /** @test */
    public function it_can_scope_active_banners()
    {
        Larabanner::factory()->create([
            'display_start_date' => now()->subDay(),
            'display_stop_date' => now()->addDay(),
        ]);

        Larabanner::factory()->create([
            'display_start_date' => now()->addDay(),
        ]);

        Larabanner::factory()->create([
            'display_start_date' => now()->subDays(2),
            'display_stop_date' => now()->subDay(),
        ]);

        $this->assertEquals(1, Larabanner::active()->count());
    }
}
