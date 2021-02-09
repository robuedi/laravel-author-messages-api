<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'body',
        'author_id',
    ];

    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id', 'id');
    }
}
