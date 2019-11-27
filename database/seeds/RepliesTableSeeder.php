<?php

use Illuminate\Database\Seeder;
use App\Models\Reply;
use App\Models\User;
use App\Models\Topic;

class RepliesTableSeeder extends Seeder
{
    public function run()
    {
        // Get all user IDs
        $user_ids = User::all()->pluck('id')->toArray();

        // Get all category IDs
        $topic_ids = Topic::all()->pluck('id')->toArray();

        // Get faker instance
        $faker = app(Faker\Generator::class);

        $replies = factory(Reply::class)
            ->times(1000)
            ->make()
            ->each(function ($reply, $index)
                use ($user_ids, $topic_ids,$faker)
            {
                $reply->user_id = $faker->randomElement($user_ids);
                $reply->topic_id = $faker->randomElement($topic_ids);
        });

        Reply::insert($replies->toArray());
    }

}

