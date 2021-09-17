<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $guarded = [];
    protected $hidden = ['pivot'];

    public function genres() {
        return $this->belongsToMany(Genre::class);
    }
}
