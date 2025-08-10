<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'date', 'clock_in', 'clock_out'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeTodayAttendance($query)
    {
        return $query->where('user_id', Auth::id())->where('date', date('Y-m-d'));
    }
}
