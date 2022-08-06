<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jemaat extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function fungsi_jemaat()
    {
        return $this->hasOne(FungsiJemaat::class, 'id', 'fungsi_dalam_jemaat_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
