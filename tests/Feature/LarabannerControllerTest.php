<?php

namespace effina\Larabanner\Tests\Feature;

use effina\Larabanner\Tests\TestCase;
use effina\Larabanner\Models\Larabanner;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LarabannerControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_display_index_page()
    {
        $banner = Larabanner::factory()->create();

        $response = $this->get(route('larabanner.index'));

        $response->assertStatus(200);
        $response->assertViewHas('banners');
        $response->assertSee($banner->name);
    }

    /** @test */
    public function it_can_display_create_page()
    {
        $response = $this->get(route('larabanner.create'));

        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_create_banner()
    {
        $bannerData = [
            'name' => 'Test Banner',
            'contents' => '<div>Test content</div>',
            'display_start_date' => now()->format('Y-m-d H:i:s'),
            'display_days' => ['mon', 'wed', 'fri'],
        ];

        $response = $this->post(route('larabanner.store'), $bannerData);

        $response->assertRedirect(route('larabanner.index'));
        $this->assertDatabaseHas('larabanners', ['name' => 'Test Banner']);
    }

    /** @test */
    public function it_validates_required_fields_on_create()
    {
        $response = $this->post(route('larabanner.store'), []);

        $response->assertSessionHasErrors(['name', 'contents', 'display_start_date']);
    }

    /** @test */
    public function it_can_display_edit_page()
    {
        $banner = Larabanner::factory()->create();

        $response = $this->get(route('larabanner.edit', $banner));

        $response->assertStatus(200);
        $response->assertViewHas('banner');
        $response->assertSee($banner->name);
    }

    /** @test */
    public function it_can_update_banner()
    {
        $banner = Larabanner::factory()->create();

        $updatedData = [
            'name' => 'Updated Banner',
            'contents' => '<div>Updated content</div>',
            'display_start_date' => now()->format('Y-m-d H:i:s'),
        ];

        $response = $this->put(route('larabanner.update', $banner), $updatedData);

        $response->assertRedirect(route('larabanner.index'));
        $this->assertDatabaseHas('larabanners', ['name' => 'Updated Banner']);
    }

    /** @test */
    public function it_can_delete_banner()
    {
        $banner = Larabanner::factory()->create();

        $response = $this->delete(route('larabanner.destroy', $banner));

        $response->assertRedirect(route('larabanner.index'));
        $this->assertSoftDeleted($banner);
    }

    /** @test */
    public function it_can_display_show_page()
    {
        $banner = Larabanner::factory()->create([
            'contents' => '<div>Test content</div>'
        ]);

        $response = $this->get(route('larabanner.show', $banner));

        $response->assertStatus(200);
        $response->assertViewHas('banner');
        $response->assertSee('Test content');
    }
}
