<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $table = 'assignment';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'attachment',
        'type',
        'category',
        'score',
        'idMaterial',
        'idStudent',
    ];

    public function Material()
    {
        return $this->belongsTo(Material::class, 'idMaterial');
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'idStudent');
    }
}
