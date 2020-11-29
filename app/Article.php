<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Spatie\Tags\HasTags;

class Article extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(category::class);
    }
}
