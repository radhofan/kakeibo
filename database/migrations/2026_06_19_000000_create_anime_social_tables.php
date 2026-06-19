<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (! Schema::hasColumn('users', 'display_name')) {
                $table->string('display_name')->nullable()->after('name');
            }

            if (! Schema::hasColumn('users', 'username')) {
                $table->string('username')->nullable()->unique()->after('display_name');
            }

            if (! Schema::hasColumn('users', 'avatar_url')) {
                $table->string('avatar_url')->nullable()->after('password');
            }

            if (! Schema::hasColumn('users', 'banner_url')) {
                $table->string('banner_url')->nullable()->after('avatar_url');
            }

            if (! Schema::hasColumn('users', 'bio')) {
                $table->text('bio')->nullable()->after('banner_url');
            }

            if (! Schema::hasColumn('users', 'location')) {
                $table->string('location')->nullable()->after('bio');
            }

            if (! Schema::hasColumn('users', 'preferred_title_language')) {
                $table->string('preferred_title_language')->default('romaji')->after('location');
            }

            if (! Schema::hasColumn('users', 'profile_visibility')) {
                $table->string('profile_visibility')->default('public')->after('preferred_title_language');
            }

            if (! Schema::hasColumn('users', 'library_visibility')) {
                $table->string('library_visibility')->default('public')->after('profile_visibility');
            }

            if (! Schema::hasColumn('users', 'activity_visibility')) {
                $table->string('activity_visibility')->default('public')->after('library_visibility');
            }

            if (! Schema::hasColumn('users', 'notification_preferences')) {
                $table->json('notification_preferences')->nullable()->after('activity_visibility');
            }

            if (! Schema::hasColumn('users', 'role')) {
                $table->string('role')->default('member')->after('notification_preferences');
            }

            if (! Schema::hasColumn('users', 'account_status')) {
                $table->string('account_status')->default('active')->after('role');
            }
        });

        Schema::create('anime', function (Blueprint $table) {
            $table->id();
            $table->string('external_id')->unique();
            $table->string('slug')->unique();
            $table->string('title_romaji');
            $table->string('title_english')->nullable();
            $table->string('title_native')->nullable();
            $table->string('preferred_display_title');
            $table->text('synopsis')->nullable();
            $table->string('cover_image_url')->nullable();
            $table->string('banner_image_url')->nullable();
            $table->string('format')->nullable();
            $table->string('status')->nullable();
            $table->unsignedInteger('episodes')->nullable();
            $table->unsignedInteger('duration')->nullable();
            $table->string('season')->nullable();
            $table->unsignedInteger('season_year')->nullable();
            $table->unsignedInteger('average_score')->nullable();
            $table->unsignedInteger('popularity')->default(0);
            $table->string('source')->nullable();
            $table->string('age_rating')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamp('metadata_last_synced_at')->nullable();
            $table->timestamps();
        });

        Schema::create('genres', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('anime_genre', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anime_id')->constrained('anime')->cascadeOnDelete();
            $table->foreignId('genre_id')->constrained()->cascadeOnDelete();
            $table->unique(['anime_id', 'genre_id']);
        });

        Schema::create('studios', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('external_id')->nullable();
            $table->timestamps();
        });

        Schema::create('anime_studio', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anime_id')->constrained('anime')->cascadeOnDelete();
            $table->foreignId('studio_id')->constrained()->cascadeOnDelete();
            $table->unique(['anime_id', 'studio_id']);
        });

        Schema::create('anime_relationships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anime_id')->constrained('anime')->cascadeOnDelete();
            $table->foreignId('related_anime_id')->constrained('anime')->cascadeOnDelete();
            $table->string('relationship_type');
            $table->timestamps();
        });

        Schema::create('library_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('anime_id')->constrained('anime')->cascadeOnDelete();
            $table->string('status')->default('planned');
            $table->unsignedInteger('progress')->default(0);
            $table->unsignedTinyInteger('user_score')->nullable();
            $table->date('started_at')->nullable();
            $table->date('completed_at')->nullable();
            $table->unsignedInteger('rewatch_count')->default(0);
            $table->boolean('is_rewatching')->default(false);
            $table->boolean('is_favorite')->default(false);
            $table->text('private_note')->nullable();
            $table->string('visibility')->default('public');
            $table->timestamps();
            $table->unique(['user_id', 'anime_id']);
        });

        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('anime_id')->constrained('anime')->cascadeOnDelete();
            $table->string('headline');
            $table->text('body');
            $table->unsignedTinyInteger('score');
            $table->boolean('contains_spoilers')->default(false);
            $table->boolean('comments_enabled')->default(true);
            $table->string('publication_status')->default('published');
            $table->timestamp('published_at')->nullable();
            $table->timestamp('edited_at')->nullable();
            $table->string('moderation_status')->default('visible');
            $table->timestamps();
            $table->unique(['user_id', 'anime_id', 'publication_status']);
        });

        Schema::create('review_likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('review_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['user_id', 'review_id']);
        });

        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('review_id')->constrained()->cascadeOnDelete();
            $table->foreignId('parent_comment_id')->nullable()->constrained('comments')->nullOnDelete();
            $table->text('body');
            $table->string('moderation_status')->default('visible');
            $table->timestamps();
        });

        Schema::create('follows', function (Blueprint $table) {
            $table->id();
            $table->foreignId('follower_user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('followed_user_id')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['follower_user_id', 'followed_user_id']);
        });

        Schema::create('blocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blocker_user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('blocked_user_id')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['blocker_user_id', 'blocked_user_id']);
        });

        Schema::create('custom_lists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->string('visibility')->default('public');
            $table->boolean('is_ordered')->default(true);
            $table->boolean('comments_enabled')->default(true);
            $table->timestamps();
            $table->unique(['user_id', 'slug']);
        });

        Schema::create('custom_list_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('custom_list_id')->constrained()->cascadeOnDelete();
            $table->foreignId('anime_id')->constrained('anime')->cascadeOnDelete();
            $table->unsignedInteger('position')->default(1);
            $table->text('note')->nullable();
            $table->timestamps();
            $table->unique(['custom_list_id', 'anime_id']);
        });

        Schema::create('custom_list_likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('custom_list_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['user_id', 'custom_list_id']);
        });

        Schema::create('saved_lists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('custom_list_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['user_id', 'custom_list_id']);
        });

        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('activity_type');
            $table->string('subject_type')->nullable();
            $table->unsignedBigInteger('subject_id')->nullable();
            $table->json('metadata')->nullable();
            $table->string('visibility')->default('public');
            $table->timestamps();
        });

        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('notification_type');
            $table->foreignId('actor_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('subject_type')->nullable();
            $table->unsignedBigInteger('subject_id')->nullable();
            $table->json('data')->nullable();
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });

        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reporter_user_id')->constrained('users')->cascadeOnDelete();
            $table->string('reportable_type');
            $table->unsignedBigInteger('reportable_id');
            $table->string('reason');
            $table->text('details')->nullable();
            $table->string('status')->default('open');
            $table->foreignId('assigned_moderator_id')->nullable()->constrained('users')->nullOnDelete();
            $table->text('resolution_note')->nullable();
            $table->timestamp('resolved_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reports');
        Schema::dropIfExists('notifications');
        Schema::dropIfExists('activities');
        Schema::dropIfExists('saved_lists');
        Schema::dropIfExists('custom_list_likes');
        Schema::dropIfExists('custom_list_entries');
        Schema::dropIfExists('custom_lists');
        Schema::dropIfExists('blocks');
        Schema::dropIfExists('follows');
        Schema::dropIfExists('comments');
        Schema::dropIfExists('review_likes');
        Schema::dropIfExists('reviews');
        Schema::dropIfExists('library_entries');
        Schema::dropIfExists('anime_relationships');
        Schema::dropIfExists('anime_studio');
        Schema::dropIfExists('studios');
        Schema::dropIfExists('anime_genre');
        Schema::dropIfExists('genres');
        Schema::dropIfExists('anime');
    }
};
