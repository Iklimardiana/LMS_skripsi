<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscussionQuestion extends Model
{
    protected $table = 'question_discussion';
    protected $fillable = ['question', 'image', 'idCategory', 'idUser', 'idSubject'];
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(CategoryDiscussion::class, 'idCategory');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'idUser');
    }

    public function answer_discussion()
    {
        return $this->hasMany(AnswerDiscussion::class, 'idQuestion');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'idSubject');
    }
}
