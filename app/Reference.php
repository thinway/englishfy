<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    protected $fillable = ['term', 'slug', 'type'];

    public function path()
    {
        return "/references/{$this->id}";
    }
}
