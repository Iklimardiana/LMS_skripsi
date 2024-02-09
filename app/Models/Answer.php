<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $table = 'answer';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'answer_content',
        'isCorrect',
        'idQuestion',
    ];

    public function Question()
    {
        return $this->belongsTo(Question::class, 'idQuestion');
    }
}
