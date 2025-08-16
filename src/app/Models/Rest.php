<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Rest extends Model
{
    use HasFactory;

    protected $fillable = ['attendance_id', 'rest_start', 'rest_end'];

    public function scopeRecordFind($query) {

        $attendance_id = Attendance::TodayAttendance()->first()->id;

        return $query->where('attendance_id', $attendance_id)
            ->whereNull('rest_end');
    }

    protected $casts = [
        'rest_start' => 'datetime',
        'rest_end' => 'datetime',
    ];

}
