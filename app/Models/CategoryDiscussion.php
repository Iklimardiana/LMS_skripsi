<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryDiscussion extends Model
{
    use HasFactory;
    protected $table = 'category_discussion';
    protected $fillable = ['name'];
    public function question()
    {
        return $this->hasMany(DiscussionQuestion::class);
    }
}
