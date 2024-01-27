<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Assignment extends Model
{
    use HasFactory;

    protected $table = 'assignment';
    protected $primaryKey = 'id';

    protected $fillable = [
        'attachment',
        'type',
        'category',
        'score',
        'idMaterial',
        'idUser',
        'idSubject',
    ];

    public function hasFile($attribute)
    {
        $file = $this->{$attribute};
        if (!empty($file) && Storage::exists($file)) {
            return true;
        }
        return false;
    }

    public function Material()
    {
        return $this->belongsTo(Material::class, 'idMaterial');
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'idUser');
    }
}
