<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $table = 'material';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'content',
        'sequence',
        'idSubject',
    ];

    public function Subject()
    {
        return $this->belongsTo(Subject::class, 'idSubject');
    }

    public function Assignment()
    {
        return $this->hasMany(Assignment::class, 'idMaterial');
    }

    public function DiscussionQuestion()
    {
        return $this->hasMany(DiscussionQuestion::class, 'idMaterial');
    }
}
