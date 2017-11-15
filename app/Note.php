<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = ['name'];

    public function words()
    {
        return $this->hasMany(Word::class);
    }
}
