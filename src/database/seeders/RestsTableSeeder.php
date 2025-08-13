<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'id' => 1,
            'attendance_id' => '1',
            'rest_start' => date('10:00:00'),
            'rest_end' => date('11:00:00')
        ];
        DB::table('rests')->insert($param);
        $param = [
            'id' => 2,
            'attendance_id' => '1',
            'rest_start' => date('12:00:00'),
            'rest_end' => date('13:00:00')
        ];
        DB::table('rests')->insert($param);
        $param = [
            'id' => 3,
            'attendance_id' => '1',
            'rest_start' => date('16:00:00'),
            'rest_end' => date('17:00:00')
        ];
        DB::table('rests')->insert($param);
    }
}
