<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SeedCategoriesData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $categories = [
            [
                'name'        => 'SHARE',
                'description' => 'Share your ideas',
            ],
            [
                'name'        => 'TUTORIAL',
                'description' => 'Guide your way',
            ],
            [
                'name'        => 'Q&A',
                'description' => 'Solve your problems',
            ],
            [
                'name'        => 'NOTICE',
                'description' => 'Keep your track',
            ],
        ];

        DB::table('categories')->insert($categories);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('categories')->truncate();
    }
}
