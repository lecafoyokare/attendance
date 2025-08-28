<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rests = [
            [
                'id' => 1,
                'attendance_id' => 1,
                'rest_start' => '10:00:00',
                'rest_end' => '11:00:00',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 2,
                'attendance_id' => 1,
                'rest_start' => '12:00:00',
                'rest_end' => '13:00:00',
                'created_at' => null,
                'updated_at' => Carbon::parse('2025-08-27 16:37:44'),
            ],
            [
                'id' => 3,
                'attendance_id' => 1,
                'rest_start' => '16:00:00',
                'rest_end' => '17:00:00',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 4,
                'attendance_id' => 4,
                'rest_start' => '20:14:20',
                'rest_end' => '20:14:20',
                'created_at' => Carbon::parse('2025-08-18 20:14:20'),
                'updated_at' => Carbon::parse('2025-08-18 20:14:20'),
            ],
            [
                'id' => 5,
                'attendance_id' => 5,
                'rest_start' => '23:36:27',
                'rest_end' => '23:37:27',
                'created_at' => Carbon::parse('2025-08-19 23:36:27'),
                'updated_at' => Carbon::parse('2025-08-19 23:37:25'),
            ],
            [
                'id' => 6,
                'attendance_id' => 6,
                'rest_start' => '23:39:29',
                'rest_end' => '23:39:30',
                'created_at' => Carbon::parse('2025-08-19 23:39:29'),
                'updated_at' => Carbon::parse('2025-08-19 23:39:30'),
            ],
            [
                'id' => 7,
                'attendance_id' => 7,
                'rest_start' => '01:18:54',
                'rest_end' => '01:18:59',
                'created_at' => Carbon::parse('2025-08-25 01:18:54'),
                'updated_at' => Carbon::parse('2025-08-25 01:18:59'),
            ],
            [
                'id' => 8,
                'attendance_id' => 9,
                'rest_start' => '01:29:54',
                'rest_end' => '01:29:54',
                'created_at' => Carbon::parse('2025-08-27 01:29:54'),
                'updated_at' => Carbon::parse('2025-08-27 01:29:54'),
            ],
        ];

        DB::table('rests')->insert($rests);
    }
}
