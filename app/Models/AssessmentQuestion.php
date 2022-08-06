<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssessmentQuestion extends Model
{
    use HasFactory;

    public function options() 
    {
        return $this->hasMany(QuestionOptions::class, 'question_id');
    }
}
