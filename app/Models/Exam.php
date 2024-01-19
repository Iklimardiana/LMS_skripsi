<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $table = 'exam';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'title',
        'type',
        'duration',
        'idSubject',
        'status',
    ];

    public function Subject()
    {
        return $this->belongsTo(Subject::class, 'idSubject');
    }

    public function Question()
    {
        return $this->hasMany(Question::class, 'idExam');
    }
}
