<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $table = 'subject';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'enrollment_key',
        'idTeacher',
        'thumbnail'
    ];

    public function Enrollment()
    {
        return $this->hasMany(Enrollment::class, 'idSubject');
    }

    public function Material()
    {
        return $this->hasMany(Material::class, 'idSubject');
    }

    public function Exam()
    {
        return $this->hasMany(Exam::class, 'idSubject');
    }

    public function Teacher()
    {
        return $this->belongsTo(User::class, 'idTeacher');
    }
    public function Discussion()
    {
        return $this->hasMany(DiscussionQuestion::class, 'idSubject');
    }

    public function Assignment()
    {
        return $this->hasMany(Assignment::class, 'idSubject');
    }
}
