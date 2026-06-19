<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('comment_likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('comment_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['user_id', 'comment_id']);
        });

        Schema::create('moderation_actions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('moderator_user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('target_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('target_type')->nullable();
            $table->unsignedBigInteger('target_id')->nullable();
            $table->string('action_type');
            $table->text('reason')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();
        });

        Schema::create('anime_people', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anime_id')->constrained('anime')->cascadeOnDelete();
            $table->string('person_type');
            $table->string('name');
            $table->string('role')->nullable();
            $table->string('image_url')->nullable();
            $table->string('voice_actor')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('anime_people');
        Schema::dropIfExists('moderation_actions');
        Schema::dropIfExists('comment_likes');
    }
};
