<?php

namespace effina\Larabanner\Tests\Feature;

use effina\Larabanner\Tests\TestCase;
use effina\Larabanner\Models\Larabanner;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Blade;

class BladeDirectiveTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_render_active_banner()
    {
        $banner = Larabanner::factory()->create([
            'display_start_date' => now()->subDay(),
            'contents' => '<div>Test Banner Content</div>'
        ]);

        $rendered = Blade::render('@banner(' . $banner->id . ')');

        $this->assertStringContainsString('Test Banner Content', $rendered);
    }

    /** @test */
    public function it_does_not_render_inactive_banner()
    {
        $banner = Larabanner::factory()->create([
            'display_start_date' => now()->addDay(),
            'contents' => '<div>Future Banner Content</div>'
        ]);

        $rendered = Blade::render('@banner(' . $banner->id . ')');

        $this->assertStringNotContainsString('Future Banner Content', $rendered);
    }

    /** @test */
    public function it_does_not_render_nonexistent_banner()
    {
        $rendered = Blade::render('@banner(999)');

        $this->assertEmpty(trim($rendered));
    }

    /** @test */
    public function it_respects_display_days()
    {
        $currentDay = strtolower(date('D'));
        $nextDay = strtolower(date('D', strtotime('tomorrow')));

        $banner = Larabanner::factory()->create([
            'display_start_date' => now()->subDay(),
            'display_days' => [$nextDay],
            'contents' => '<div>Day Specific Content</div>'
        ]);

        $rendered = Blade::render('@banner(' . $banner->id . ')');

        $this->assertStringNotContainsString('Day Specific Content', $rendered);
    }

    /** @test */
    public function it_handles_html_content_safely()
    {
        $banner = Larabanner::factory()->create([
            'display_start_date' => now()->subDay(),
            'contents' => '<script>alert("xss")</script><div>Safe Content</div>'
        ]);

        $rendered = Blade::render('@banner(' . $banner->id . ')');

        $this->assertStringContainsString('<script>alert("xss")</script>', $rendered);
        $this->assertStringContainsString('<div>Safe Content</div>', $rendered);
    }
}
