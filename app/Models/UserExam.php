<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserExam extends Model
{
    use HasFactory;

    protected $table = 'user_exam';
    protected $fillable = [
        'begin',
        'finish',
        'score',
        'status',
        'idExam',
        'idStudent',
    ];

    public function Exam()
    {
        return $this->belongsTo(Exam::class, 'idExam');
    }

    public function Student()
    {
        return $this->belongsTo(User::class, 'idStudent');
    }

    public function UserAnswer()
    {
        return $this->hasMany(UserAnswer::class, 'idUserExam');
    }
}
