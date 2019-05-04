<?php

use App\Models\Comment;
use App\Models\Media;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 2)->create()->each(function ($u) {
            factory(Media::class, 5)->create(['user_id' => $u->id]);
            $posts = factory(Post::class, 10)->create(['user_id' => $u->id]);
            foreach ($posts as $post) {
                $post->tags()->saveMany(factory(Tag::class, random_int(1, 3))->make());
                $post->comments()->saveMany(factory(Comment::class, random_int(1, 5))->make(['post_id' => $post->id]));
            }
        });
    }
}
