<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('province')->insert([
            [
                'prov_id' => '11',
                'prov_name' => 'DAERAH KHUSUS IBUKOTA JAKARTA',
            ]
        ]);

        DB::table('city')->insert([
            [
                'city_id' => '152',
                'city_name' => 'JAKARTA UTARA',
                'prov_id' => '11',
            ],[
                'city_id' => '153',
                'city_name' => 'JAKARTA BARAT',
                'prov_id' => '11',
            ],[
                'city_id' => '154',
                'city_name' => 'JAKARTA TIMUR',
                'prov_id' => '11',
            ],[
                'city_id' => '155',
                'city_name' => 'JAKARTA SELATAN',
                'prov_id' => '11',
            ],[
                'city_id' => '156',
                'city_name' => 'JAKARTA PUSAT',
                'prov_id' => '11',
            ],[
                'city_id' => '157',
                'city_name' => 'KEPULAUAN SERIBU',
                'prov_id' => '11',
            ]
        ]);

        $path1 = public_path('/SQL/district.sql');
        $sql1 = file_get_contents($path1);
        DB::unprepared($sql1);

        $path2 = public_path('/SQL/postal_code.sql');
        $sql2 = file_get_contents($path2);
        DB::unprepared($sql2);

        $path3 = public_path('/SQL/faker.sql');
        $sql3 = file_get_contents($path3);
        DB::unprepared($sql3);
    }
}
