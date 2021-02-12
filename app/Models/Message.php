<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';
    protected $primaryKey = 'id';
    protected $fillable = [
        'body',
        'author_id',
    ];

    public function author()
    {
        return $this->hasOne(Author::class);
    }
}
