<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progres extends Model
{
    use HasFactory;
    protected $table = 'progres';
    protected $primaryKey = 'id';

    protected $fillable = [
        'status',
        'sequence',
        'complete',
        'idUser',
        'idSubject',
    ];

    public function Material()
    {
        return $this->belongsTo(Material::class, 'idMaterial');
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'idUser');
    }
}
