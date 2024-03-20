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

    public function trueAnswer()
    {
        return $this->hasOne(Answer::class, 'idQuestion')->where('isCorrect', '1');
    }

    public function userAnswer()
    {
        return $this->hasOne(UserAnswer::class)->whereHas('userExam', function ($query) {
            $query->where('idStudent', auth()->id());
        });
    }
}
