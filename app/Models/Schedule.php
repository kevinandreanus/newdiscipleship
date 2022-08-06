<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{

    public function details()
    {
        return $this->hasMany(ScheduleDetail::class, 'parent_id', 'id');
    }

    public function getPIC()
    {
        return $this->hasOne(User::class, 'id', 'pic');
    }

    public function getNotes()
    {
        return $this->hasMany(EventNote::class);
    }
}
