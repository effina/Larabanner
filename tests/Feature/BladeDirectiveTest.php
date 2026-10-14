<?php

namespace effina\Larabanner\Tests\Feature;

use effina\Larabanner\Tests\TestCase;
use effina\Larabanner\Models\Larabanner;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Illuminate\Support\Facades\Blade;

class BladeDirectiveTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_render_active_banner()
    {
        $banner = Larabanner::factory()->create([
            'display_start_date' => now()->subDay(),
            'display_days' => null,
            'contents' => '<div>Test Banner Content</div>'
        ]);

        $rendered = Blade::render('@banner(' . $banner->id . ')');

        $this->assertStringContainsString('Test Banner Content', $rendered);
    }

    #[Test]
    public function it_does_not_render_inactive_banner()
    {
        $banner = Larabanner::factory()->create([
            'display_start_date' => now()->addDay(),
            'contents' => '<div>Future Banner Content</div>'
        ]);

        $rendered = Blade::render('@banner(' . $banner->id . ')');

        $this->assertStringNotContainsString('Future Banner Content', $rendered);
    }

    #[Test]
    public function it_does_not_render_nonexistent_banner()
    {
        $rendered = Blade::render('@banner(999)');

        $this->assertEmpty(trim($rendered));
    }

    #[Test]
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

    #[Test]
    public function it_handles_html_content_safely()
    {
        $banner = Larabanner::factory()->create([
            'display_start_date' => now()->subDay(),
            'display_days' => null,
            'contents' => '<script>alert("xss")</script><div>Safe Content</div>'
        ]);

        $rendered = Blade::render('@banner(' . $banner->id . ')');

        $this->assertStringContainsString('<script>alert("xss")</script>', $rendered);
        $this->assertStringContainsString('<div>Safe Content</div>', $rendered);
    }

    #[Test]
    public function it_renders_only_the_requested_banner()
    {
        $requested = Larabanner::factory()->create([
            'display_start_date' => now()->subDay(),
            'display_days' => null,
            'contents' => '<div>Requested Banner</div>'
        ]);

        Larabanner::factory()->create([
            'display_start_date' => now()->subDay(),
            'display_days' => null,
            'contents' => '<div>Other Banner</div>'
        ]);

        $rendered = Blade::render('@banner(' . $requested->id . ')');

        $this->assertStringContainsString('Requested Banner', $rendered);
        $this->assertStringNotContainsString('Other Banner', $rendered);
    }

    #[Test]
    public function it_renders_all_active_banners_without_an_id()
    {
        Larabanner::factory()->create([
            'display_start_date' => now()->subDay(),
            'display_days' => null,
            'contents' => '<div>First Banner</div>'
        ]);

        Larabanner::factory()->create([
            'display_start_date' => now()->subDay(),
            'display_days' => null,
            'contents' => '<div>Second Banner</div>'
        ]);

        Larabanner::factory()->create([
            'display_start_date' => now()->addDay(),
            'display_days' => null,
            'contents' => '<div>Future Banner</div>'
        ]);

        $rendered = Blade::render('@banner');

        $this->assertStringContainsString('First Banner', $rendered);
        $this->assertStringContainsString('Second Banner', $rendered);
        $this->assertStringNotContainsString('Future Banner', $rendered);
    }

    #[Test]
    public function it_accepts_a_variable_as_the_banner_id()
    {
        $banner = Larabanner::factory()->create([
            'display_start_date' => now()->subDay(),
            'display_days' => null,
            'contents' => '<div>Variable Banner</div>'
        ]);

        $rendered = Blade::render('@banner($bannerId)', ['bannerId' => $banner->id]);

        $this->assertStringContainsString('Variable Banner', $rendered);
    }

    #[Test]
    public function it_does_not_overwrite_view_variables()
    {
        Larabanner::factory()->create([
            'display_start_date' => now()->subDay(),
            'display_days' => null,
        ]);

        $rendered = Blade::render('@banner {{ $banner }}', ['banner' => 'original value']);

        $this->assertStringContainsString('original value', $rendered);
    }
}
