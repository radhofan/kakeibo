<?php

namespace Tests\Feature;

use App\Models\Anime;
use App\Models\CustomList;
use App\Models\Review;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AnimeProductFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_visitors_can_open_public_discovery_pages(): void
    {
        $this->seed();

        $this->get('/')->assertOk()->assertSee('Kakeibo Anime');
        $this->get('/discover')->assertOk()->assertSee('Discover Anime');
        $this->get('/reviews')->assertOk()->assertSee('Community Reviews');
    }

    public function test_user_can_register_and_open_home(): void
    {
        $this->post('/register', [
            'display_name' => 'New Viewer',
            'username' => 'new-viewer',
            'email' => 'new@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ])->assertRedirect('/home');

        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', ['username' => 'new-viewer']);
    }

    public function test_authenticated_user_can_write_review(): void
    {
        $this->seed();

        $user = User::factory()->create();
        $anime = Anime::first();

        $this->actingAs($user)->post(route('reviews.store', $anime), [
            'headline' => 'A strong first impression',
            'body' => 'This review has enough detail to pass validation and explain why the anime worked for this viewer.',
            'score' => 88,
            'publication_status' => 'published',
        ])->assertRedirect();

        $this->assertDatabaseHas('reviews', [
            'user_id' => $user->id,
            'anime_id' => $anime->id,
            'score' => 88,
        ]);
    }

    public function test_user_can_comment_report_and_like_list(): void
    {
        $this->seed();

        $user = User::factory()->create();
        $review = Review::first();
        $list = CustomList::first();

        $this->actingAs($user)->post(route('comments.store', $review), [
            'body' => 'This is a useful review and it helped me choose what to watch next.',
        ])->assertSessionHas('status');

        $this->actingAs($user)->post(route('reports.store'), [
            'type' => 'review',
            'id' => $review->id,
            'reason' => 'other',
            'details' => 'Feature test report.',
        ])->assertRedirect(route('reports.thanks'));

        $this->actingAs($user)->post(route('lists.like', $list))->assertSessionHas('status');

        $this->assertDatabaseHas('comments', ['user_id' => $user->id, 'review_id' => $review->id]);
        $this->assertDatabaseHas('reports', ['reporter_user_id' => $user->id, 'reportable_id' => $review->id]);
        $this->assertDatabaseHas('custom_list_likes', ['user_id' => $user->id, 'custom_list_id' => $list->id]);
    }

    public function test_admin_can_open_moderation_pages(): void
    {
        $this->seed();

        $admin = User::where('role', 'admin')->first();

        $this->actingAs($admin)->get(route('admin.users'))->assertOk()->assertSee('User Moderation');
        $this->actingAs($admin)->get(route('admin.reviews'))->assertOk()->assertSee('Review Moderation');
        $this->actingAs($admin)->get(route('admin.comments'))->assertOk()->assertSee('Comment Moderation');
        $this->actingAs($admin)->get(route('admin.reports'))->assertOk()->assertSee('Reports Queue');
        $this->actingAs($admin)->get(route('admin.anime-cache'))->assertOk()->assertSee('Anime Cache');
    }

    public function test_core_detail_and_settings_pages_render(): void
    {
        $this->seed();

        $user = User::where('username', 'demo')->first();
        $anime = Anime::first();
        $review = Review::first();
        $list = CustomList::first();

        $this->get(route('anime.show', $anime))->assertOk()->assertSee('Overview')->assertSee('Characters');
        $this->get(route('reviews.show', $review))->assertOk()->assertSee($review->headline);
        $this->get(route('lists.show', $list))->assertOk()->assertSee($list->title);

        $this->actingAs($user)->get(route('notifications.index'))->assertOk()->assertSee('Notifications');
        $this->actingAs($user)->get(route('settings.account'))->assertOk()->assertSee('Account Settings');
        $this->actingAs($user)->get(route('profiles.followers', $user))->assertOk()->assertSee('Followers');
    }
}
