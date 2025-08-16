<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttendancesTableSeeder extends Seeder
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
            'user_id' => '1',
            'date' => date('2025-08-06'),
            'clock_in' => date('08:00:00'),
            'clock_out' => date('17:00:00')
        ];
        DB::table('attendances')->insert($param);
        $param = [
            'id' => 2,
            'user_id' => '1',
            'date' => date('2025-08-07'),
            'clock_in' => date('H:i:s'),
            'clock_out' => date('H:i:s')
        ];
        DB::table('attendances')->insert($param);
        $param = [
            'id' => 3,
            'user_id' => '1',
            'date' => date('2025-08-08'),
            'clock_in' => date('H:i:s'),
            'clock_out' => date('H:i:s')
        ];
        DB::table('attendances')->insert($param);
    }
}
