<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleDetail extends Model
{
    use HasFactory;

    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'id', 'parent_id');
    }

    public function guests()
    {
        return $this->hasMany(User::class, 'id', 'user_id');
    }
}
