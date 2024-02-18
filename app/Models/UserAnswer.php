<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    use HasFactory;

    protected $table = 'user_answer';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_answer',
        'is_correct',
        'idUserExam',
        'idQuestion',
    ];
    public function Question()
    {
        return $this->belongsTo(Question::class, 'idQuestion');
    }

    public function userExam()
    {
        return $this->belongsTo(UserExam::class, 'idUserExam');
    }
}
