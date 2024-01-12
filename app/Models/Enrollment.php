<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $table = 'enrollment';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'verification',
        'idSubject',
        'idUser'
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'idUser');
    }

    public function Subject()
    {
        return $this->belongsTo(Subject::class, 'idSubject');
    }
}
