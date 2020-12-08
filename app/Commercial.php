<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commercial extends Model
{
    public function photo()
    {
        return $this->belongsTo(Photo::class,'banner');
    }
}
