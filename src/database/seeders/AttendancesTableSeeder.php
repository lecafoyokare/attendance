<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
            'user_id' => 1,
            'date' => '2025-08-06',
            'clock_in' => '08:00:00',
            'clock_out' => '17:00:00',
            'rest' => '03:00:00',
            'total' => '06:00:00',
            'reason' => 'reason',
            'approval_status' => 0,
            'created_at' => Carbon::parse('2025-08-27 16:45:34'),
            'updated_at' => null,
        ];
        DB::table('attendances')->insert($param);

        $param = [
            'id' => 2,
            'user_id' => 1,
            'date' => '2025-08-07',
            'clock_in' => '09:55:00',
            'clock_out' => '09:55:00',
            'rest' => '00:00:00',
            'total' => '00:00:00',
            'reason' => null,
            'approval_status' => 0,
            'created_at' => Carbon::parse('2025-08-27 16:33:52'),
            'updated_at' => null,
        ];
        DB::table('attendances')->insert($param);

        $param = [
            'id' => 3,
            'user_id' => 1,
            'date' => '2025-08-08',
            'clock_in' => '09:55:35',
            'clock_out' => '09:55:35',
            'rest' => null,
            'total' => null,
            'reason' => null,
            'approval_status' => 0,
            'created_at' => null,
            'updated_at' => null,
        ];
        DB::table('attendances')->insert($param);

        $param = [
            'id' => 4,
            'user_id' => 1,
            'date' => '2025-08-18',
            'clock_in' => '20:14:00',
            'clock_out' => '20:14:00',
            'rest' => '00:00:00',
            'total' => '00:00:02',
            'reason' => null,
            'approval_status' => 0,
            'created_at' => Carbon::parse('2025-08-18 20:14:19'),
            'updated_at' => Carbon::parse('2025-08-27 01:23:36'),
        ];
        DB::table('attendances')->insert($param);

        $param = [
            'id' => 5,
            'user_id' => 2,
            'date' => '2025-08-19',
            'clock_in' => '23:36:25',
            'clock_out' => '23:38:09',
            'rest' => '00:00:58',
            'total' => '00:00:46',
            'reason' => null,
            'approval_status' => 0,
            'created_at' => Carbon::parse('2025-08-19 23:36:25'),
            'updated_at' => Carbon::parse('2025-08-19 23:38:09'),
        ];
        DB::table('attendances')->insert($param);

        $param = [
            'id' => 6,
            'user_id' => 1,
            'date' => '2025-08-19',
            'clock_in' => '23:39:28',
            'clock_out' => '23:39:31',
            'rest' => '00:00:01',
            'total' => '00:00:02',
            'reason' => null,
            'approval_status' => 0,
            'created_at' => Carbon::parse('2025-08-19 23:39:28'),
            'updated_at' => Carbon::parse('2025-08-19 23:39:31'),
        ];
        DB::table('attendances')->insert($param);

        $param = [
            'id' => 7,
            'user_id' => 2,
            'date' => '2025-08-25',
            'clock_in' => '00:48:10',
            'clock_out' => '01:19:00',
            'rest' => '00:00:05',
            'total' => '00:30:45',
            'reason' => null,
            'approval_status' => 0,
            'created_at' => Carbon::parse('2025-08-25 00:48:10'),
            'updated_at' => Carbon::parse('2025-08-25 01:19:00'),
        ];
        DB::table('attendances')->insert($param);

        $param = [
            'id' => 8,
            'user_id' => 1,
            'date' => '2025-08-26',
            'clock_in' => '19:04:05',
            'clock_out' => null,
            'rest' => null,
            'total' => null,
            'reason' => null,
            'approval_status' => 0,
            'created_at' => Carbon::parse('2025-08-26 19:04:05'),
            'updated_at' => Carbon::parse('2025-08-26 19:04:05'),
        ];
        DB::table('attendances')->insert($param);

        $param = [
            'id' => 9,
            'user_id' => 1,
            'date' => '2025-08-27',
            'clock_in' => '00:47:54',
            'clock_out' => '01:31:36',
            'rest' => '00:00:00',
            'total' => '00:43:42',
            'reason' => null,
            'approval_status' => 0,
            'created_at' => Carbon::parse('2025-08-27 00:47:54'),
            'updated_at' => Carbon::parse('2025-08-27 01:31:36'),
        ];
        DB::table('attendances')->insert($param);
    }
}
