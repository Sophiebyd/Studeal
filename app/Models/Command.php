<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Command extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'article_id',
        'user_id'
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
    
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }


}
