<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Rest extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'date', 'rest_start', 'rest_end'];

    public function scopeRecordFind($query) {
        return $query->where('user_id', Auth::id())
            ->where('date', date('Y-m-d'))
            ->whereNull('rest_end');
    }

}
