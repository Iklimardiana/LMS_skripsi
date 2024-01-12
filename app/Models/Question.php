<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $table = 'question';
    protected $primaryKey = 'id';

    protected $fillable = [
        'content',
        'idExam',
    ];

    public function Exam()
    {
        return $this->belongsTo(Exam::class, 'idExam');
    }

    public function Answer()
    {
        return $this->hasMany(Answer::class, 'idQuestion');
    }

    public function UserAnswer()
    {
        return $this->hasMany(UserAnswer::class, 'idQuestion');
    }
}
