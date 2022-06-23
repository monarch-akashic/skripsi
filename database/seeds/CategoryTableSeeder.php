<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('skill_categories')->insert([
            [
                'id' => '1',
                'name' => 'Public Speaking',
            ],[
                'id' => '2',
                'name' => 'Leadership',
            ],[
                'id' => '3',
                'name' => 'Communication',
            ],[
                'id' => '4',
                'name' => 'People Management',
            ],[
                'id' => '5',
                'name' => 'Analytical',
            ]
        ]);
    }
}
