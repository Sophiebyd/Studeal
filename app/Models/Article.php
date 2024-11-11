<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $with = [
        'pictures'
    ];
    
    protected $fillable = [
        'title',
        'address',
        'price',
        'content',
        'picture',
        'category_id',
        'created_at'
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function pictures()
    {
        return $this->hasMany(Picture::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
