<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Anime;
use App\Models\AnimePerson;
use App\Models\AppNotification;
use App\Models\CustomList;
use App\Models\Genre;
use App\Models\Report;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $users = collect([
            ['Demo User', 'demo', 'demo@kakeibo.test', 'member', 'active'],
            ['Mira Reviewer', 'mira', 'mira@kakeibo.test', 'member', 'active'],
            ['Admin Curator', 'admin', 'admin@kakeibo.test', 'admin', 'active'],
            ['Suspended Sample', 'suspended', 'suspended@kakeibo.test', 'member', 'suspended'],
        ])->map(fn ($user) => User::query()->updateOrCreate(
            ['email' => $user[2]],
            [
                'name' => $user[0],
                'display_name' => $user[0],
                'username' => $user[1],
                'password' => Hash::make('password'),
                'avatar_url' => 'https://api.dicebear.com/8.x/initials/svg?seed='.urlencode($user[0]),
                'banner_url' => 'https://images.unsplash.com/photo-1519681393784-d120267933ba?auto=format&fit=crop&w=1400&q=80',
                'bio' => $user[1] === 'mira' ? 'I write spoiler-safe reviews and love character-driven shows.' : 'Tracking anime, reviews, and lists on Kakeibo Anime.',
                'location' => 'Online',
                'role' => $user[3],
                'account_status' => $user[4],
            ],
        ));

        $genres = collect(['Action', 'Adventure', 'Comedy', 'Drama', 'Fantasy', 'Mystery', 'Romance', 'Sci-Fi', 'Slice of Life', 'Supernatural'])
            ->mapWithKeys(fn ($name) => [$name => Genre::query()->firstOrCreate(['slug' => Str::slug($name)], ['name' => $name])]);

        $animeData = [
            ['frieren-beyond-journeys-end', 'Frieren: Beyond Journey\'s End', 'Sousou no Frieren', '葬送のフリーレン', 'After the hero party defeats the Demon King, an elf mage begins a quiet journey through memory, grief, and new companionship.', 'https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx154587-gHSraOSa0nBG.jpg', 'https://s4.anilist.co/file/anilistcdn/media/anime/banner/154587-YMd1pmEQf5VZ.jpg', 'TV', 'finished_airing', 28, 24, 'fall', 2023, 91, 450000, ['Adventure', 'Drama', 'Fantasy']],
            ['fullmetal-alchemist-brotherhood', 'Fullmetal Alchemist: Brotherhood', 'Hagane no Renkinjutsushi', '鋼の錬金術師', 'Two brothers search for the Philosopher\'s Stone after an alchemy experiment costs them everything.', 'https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx5114-KJTQz9AIm6Wk.jpg', 'https://s4.anilist.co/file/anilistcdn/media/anime/banner/5114.jpg', 'TV', 'finished_airing', 64, 24, 'spring', 2009, 90, 640000, ['Action', 'Adventure', 'Drama', 'Fantasy']],
            ['attack-on-titan', 'Attack on Titan', 'Shingeki no Kyojin', '進撃の巨人', 'Humanity fights for survival behind walls while the truth of the titans changes everything.', 'https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx16498-C6FPmWm59CyP.jpg', 'https://s4.anilist.co/file/anilistcdn/media/anime/banner/16498-m5ZMNtFioc7j.jpg', 'TV', 'finished_airing', 25, 24, 'spring', 2013, 84, 700000, ['Action', 'Drama', 'Mystery']],
            ['violet-evergarden', 'Violet Evergarden', 'Violet Evergarden', 'ヴァイオレット・エヴァーガーデン', 'A former soldier becomes an Auto Memory Doll and learns how words carry love and loss.', 'https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx21827-10F6m50H4GJK.jpg', 'https://s4.anilist.co/file/anilistcdn/media/anime/banner/21827-WIu6bYk8VZ3x.jpg', 'TV', 'finished_airing', 13, 24, 'winter', 2018, 85, 380000, ['Drama', 'Fantasy', 'Slice of Life']],
            ['spy-x-family', 'SPY x FAMILY', 'SPY x FAMILY', 'SPY×FAMILY', 'A spy, an assassin, and a telepath become a fake family with very real emotional stakes.', 'https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx140960-vN39AmOWrVB5.jpg', 'https://s4.anilist.co/file/anilistcdn/media/anime/banner/140960-H5XHJYgD19zG.jpg', 'TV', 'finished_airing', 12, 24, 'spring', 2022, 82, 520000, ['Action', 'Comedy', 'Slice of Life']],
            ['your-name', 'Your Name.', 'Kimi no Na wa.', '君の名は。', 'Two teenagers mysteriously swap bodies and chase a connection that stretches across time.', 'https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx21519-fPhvy69vnQqS.png', 'https://s4.anilist.co/file/anilistcdn/media/anime/banner/21519-1ayMXgUQmU1A.jpg', 'Movie', 'finished_airing', 1, 106, 'summer', 2016, 84, 480000, ['Drama', 'Romance', 'Supernatural']],
            ['mob-psycho-100', 'Mob Psycho 100', 'Mob Psycho 100', 'モブサイコ100', 'A powerful psychic tries to grow up kindly while bizarre supernatural pressure keeps escalating.', 'https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx21507-9m1Lz4J5L7cS.jpg', 'https://s4.anilist.co/file/anilistcdn/media/anime/banner/21507-HhbgxCzM1gTc.jpg', 'TV', 'finished_airing', 12, 24, 'summer', 2016, 84, 360000, ['Action', 'Comedy', 'Supernatural']],
            ['made-in-abyss', 'Made in Abyss', 'Made in Abyss', 'メイドインアビス', 'Young explorers descend into a beautiful and brutal abyss where each layer asks a higher price.', 'https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx97986-azK5OQBA9OL8.jpg', 'https://s4.anilist.co/file/anilistcdn/media/anime/banner/97986-7zKQxY2dQ1jR.jpg', 'TV', 'finished_airing', 13, 24, 'summer', 2017, 84, 300000, ['Adventure', 'Drama', 'Fantasy', 'Mystery']],
        ];

        $anime = collect($animeData)->map(function ($item) use ($genres) {
            $record = Anime::query()->updateOrCreate(
                ['slug' => $item[0]],
                [
                    'external_id' => $item[0],
                    'title_romaji' => $item[2],
                    'title_english' => $item[1],
                    'title_native' => $item[3],
                    'preferred_display_title' => $item[1],
                    'synopsis' => $item[4],
                    'cover_image_url' => $item[5],
                    'banner_image_url' => $item[6],
                    'format' => $item[7],
                    'status' => $item[8],
                    'episodes' => $item[9],
                    'duration' => $item[10],
                    'season' => $item[11],
                    'season_year' => $item[12],
                    'average_score' => $item[13],
                    'popularity' => $item[14],
                    'source' => 'Manga',
                    'age_rating' => 'PG-13',
                    'metadata' => ['trending' => $item[14] + $item[13]],
                    'metadata_last_synced_at' => now(),
                ],
            );

            $record->genres()->sync(collect($item[15])->map(fn ($name) => $genres[$name]->id));

            return $record;
        });

        $demo = $users->firstWhere('username', 'demo');
        $mira = $users->firstWhere('username', 'mira');
        $admin = $users->firstWhere('username', 'admin');

        $demo->following()->syncWithoutDetaching([$mira->id]);

        foreach ($anime->take(5) as $index => $item) {
            $demo->libraryEntries()->updateOrCreate(
                ['anime_id' => $item->id],
                [
                    'status' => ['watching', 'completed', 'planned', 'on-hold', 'dropped'][$index],
                    'progress' => min($item->episodes ?: 1, [6, 28, 0, 3, 1][$index]),
                    'user_score' => [null, 96, null, 82, 70][$index],
                    'visibility' => 'public',
                    'is_favorite' => $index === 1,
                ],
            );
        }

        $review = Review::query()->updateOrCreate(
            ['user_id' => $mira->id, 'anime_id' => $anime[0]->id, 'publication_status' => 'published'],
            [
                'headline' => 'A fantasy journey that understands quiet time',
                'body' => 'Frieren works because the adventure is not treated as a checklist. Each town, spell, and memory gives the characters another way to understand what they missed before. It is patient, beautiful, and emotionally direct without turning every scene into a speech.',
                'score' => 96,
                'contains_spoilers' => false,
                'comments_enabled' => true,
                'published_at' => now()->subDays(2),
                'moderation_status' => 'visible',
            ],
        );

        $review->comments()->updateOrCreate(
            ['user_id' => $demo->id],
            ['body' => 'This made me move it to the top of my weekend list.', 'moderation_status' => 'visible'],
        );

        $review->likes()->firstOrCreate(['user_id' => $demo->id]);

        AnimePerson::query()->updateOrCreate(
            ['anime_id' => $anime[0]->id, 'person_type' => 'character', 'name' => 'Frieren'],
            ['role' => 'Main', 'voice_actor' => 'Atsumi Tanezaki'],
        );
        AnimePerson::query()->updateOrCreate(
            ['anime_id' => $anime[0]->id, 'person_type' => 'character', 'name' => 'Fern'],
            ['role' => 'Main', 'voice_actor' => 'Kana Ichinose'],
        );
        AnimePerson::query()->updateOrCreate(
            ['anime_id' => $anime[0]->id, 'person_type' => 'staff', 'name' => 'Keiichiro Saito'],
            ['role' => 'Director'],
        );
        AnimePerson::query()->updateOrCreate(
            ['anime_id' => $anime[0]->id, 'person_type' => 'staff', 'name' => 'Madhouse'],
            ['role' => 'Studio'],
        );

        $list = CustomList::query()->updateOrCreate(
            ['user_id' => $mira->id, 'slug' => 'starter-anime-with-heart'],
            [
                'title' => 'Starter Anime With Heart',
                'description' => 'Accessible shows and films with strong emotional hooks.',
                'visibility' => 'public',
                'is_ordered' => true,
                'comments_enabled' => true,
            ],
        );

        $list->entries()->delete();
        foreach ($anime->take(4) as $position => $item) {
            $list->entries()->create(['anime_id' => $item->id, 'position' => $position + 1]);
        }

        Activity::query()->updateOrCreate(
            ['user_id' => $mira->id, 'activity_type' => 'review_published', 'subject_type' => Review::class, 'subject_id' => $review->id],
            ['metadata' => ['anime' => $anime[0]->preferred_display_title], 'visibility' => 'public'],
        );

        AppNotification::query()->updateOrCreate(
            ['user_id' => $demo->id, 'notification_type' => 'review_liked', 'subject_type' => Review::class, 'subject_id' => $review->id],
            ['actor_user_id' => $mira->id, 'data' => ['message' => 'Mira liked a review you commented on.']],
        );

        Report::query()->updateOrCreate(
            ['reporter_user_id' => $demo->id, 'reportable_type' => Review::class, 'reportable_id' => $review->id],
            ['reason' => 'spoilers_not_marked', 'details' => 'Demo moderation report.', 'status' => 'open', 'assigned_moderator_id' => $admin->id],
        );
    }
}
