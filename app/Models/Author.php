<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $table = 'authors';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
    ];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
