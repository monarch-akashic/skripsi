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
        DB::table('categories')->insert([
            [
                'id' => '1',
                'type' => 'SK',
                'name' => 'Public Speaking',
            ],[
                'id' => '2',
                'type' => 'SK',
                'name' => 'Leadership',
            ],[
                'id' => '3',
                'type' => 'SK',
                'name' => 'Communication',
            ],[
                'id' => '4',
                'type' => 'SK',
                'name' => 'People Management',
            ],[
                'id' => '5',
                'type' => 'SK',
                'name' => 'Analytical',
            ],[
                'id' => '6',
                'type' => 'ED',
                'name' => 'SD',
            ],[
                'id' => '7',
                'type' => 'ED',
                'name' => 'SMP',
            ],[
                'id' => '8',
                'type' => 'ED',
                'name' => 'SMA',
            ],[
                'id' => '9',
                'type' => 'ED',
                'name' => 'SMK',
            ],[
                'id' => '10',
                'type' => 'ED',
                'name' => 'D3',
            ],[
                'id' => '11',
                'type' => 'ED',
                'name' => 'S1',
            ],[
                'id' => '12',
                'type' => 'EX',
                'name' => 'fulltime',
            ],[
                'id' => '13',
                'type' => 'EX',
                'name' => 'magang',
            ],[
                'id' => '14',
                'type' => 'IT',
                'name' => 'Agriculture',
            ],[
                'id' => '15',
                'type' => 'IT',
                'name' => 'Computer and technology',
            ],[
                'id' => '16',
                'type' => 'IT',
                'name' => 'Construction',
            ],[
                'id' => '17',
                'type' => 'IT',
                'name' => 'Education',
            ],[
                'id' => '18',
                'type' => 'IT',
                'name' => 'Energy',
            ],[
                'id' => '19',
                'type' => 'IT',
                'name' => 'Entertainment',
            ],[
                'id' => '20',
                'type' => 'IT',
                'name' => 'Fashion',
            ],[
                'id' => '21',
                'type' => 'IT',
                'name' => 'Finance and economic',
            ],[
                'id' => '22',
                'type' => 'IT',
                'name' => 'Food and beverage',
            ],[
                'id' => '23',
                'type' => 'IT',
                'name' => 'Health care',
            ],[
                'id' => '24',
                'type' => 'IT',
                'name' => 'Hospitality',
            ],[
                'id' => '25',
                'type' => 'IT',
                'name' => 'Manufacturing',
            ],[
                'id' => '26',
                'type' => 'IT',
                'name' => 'Media and news',
            ],[
                'id' => '27',
                'type' => 'IT',
                'name' => 'Mining',
            ],[
                'id' => '28',
                'type' => 'IT',
                'name' => 'Pharmaceutical',
            ],[
                'id' => '29',
                'type' => 'IT',
                'name' => 'Telecommunication',
            ],[
                'id' => '30',
                'type' => 'IT',
                'name' => 'Transportation',
            ],[
                'id' => '31',
                'type' => 'IS',
                'name' => 'Micro',
            ],[
                'id' => '32',
                'type' => 'IS',
                'name' => 'Small',
            ],[
                'id' => '33',
                'type' => 'IS',
                'name' => 'Middle',
            ],[
                'id' => '34',
                'type' => 'IS',
                'name' => 'Large',
            ]
        ]);
    }
}
