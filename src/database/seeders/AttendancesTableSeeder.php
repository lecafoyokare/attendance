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
            'user_id' => '1',
            'date' => date('Y-m-d'),
            'clock_in' => date('H:i:s'),
            // 'clock_out' => 'American'
        ];
        DB::table('attendances')->insert($param);
    }
}
