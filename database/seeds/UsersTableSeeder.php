<?php

use Illuminate\Database\Seeder;
use App\Models\User;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get Faker instance
        $faker = app(Faker\Generator::class);

        // Fake avatars
        $avatars = [
            'https://cdn.learnku.com/uploads/images/201710/14/1/s5ehp11z6s.png',
            'https://cdn.learnku.com/uploads/images/201710/14/1/Lhd1SHqu86.png',
            'https://cdn.learnku.com/uploads/images/201710/14/1/LOnMrqbHJn.png',
            'https://cdn.learnku.com/uploads/images/201710/14/1/xAuDMxteQy.png',
            'https://cdn.learnku.com/uploads/images/201710/14/1/ZqM7iaP4CR.png',
            'https://cdn.learnku.com/uploads/images/201710/14/1/NDnzMutoxX.png',
        ];

        // Generate data
        $users = factory(User::class)
            ->times(10)
            ->make()
            ->each(function ($user, $index)
            use ($faker, $avatars)
            {
                // Add avatar randomly
                $user->avatar = $faker->randomElement($avatars);
            });

        // Make $hidden attributes visible
        $user_array = $users->makeVisable(['password', 'remember_token'])->toArray();

        // Insert data into the database
        User::insert($user_array);

        // Config data of the first user
        $user = User::all()->find(1);
        $user->name = 'Jobs';
        $user->email = 'jobs@test.com';
        $user->avatar = 'http://larabbs.test/uploads/images/avatars/201911/24/1_1574558487_NAziUJi8hr.png';
        $user->save();

        // Set user1 as Founder
        $user->assignRole('Founder');

        // Set user2 as Maintainer
        $user = User::find(2);
        $user->assignRole('Maintainer');
    }
}
