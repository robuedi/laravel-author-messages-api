<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $table = 'authors';

    protected $fillable = [
        'name',
    ];

    public function messages()
    {
        return $this->hasMany(Message::class, 'author_id', 'id');
    }
}
