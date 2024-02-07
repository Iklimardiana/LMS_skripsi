<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerDiscussion extends Model
{
    use HasFactory;
    protected $table = 'answer_discussion';
    protected $fillable = [
        'answer',
        'image',
        'idQuestion',
        'idUser'
    ];
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'idUser');
    }

    public function question()
    {
        return $this->belongsTo(DiscussionQuestion::class, 'idQuestion');
    }

}
