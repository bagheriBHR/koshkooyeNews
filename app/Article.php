<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Spatie\Tags\HasTags;

class Article extends Model
{
    use HasTags;
    protected $fillable = ['tags'];
    public function user()
    {
        return $this->belongsTo(User::class,'author_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function photos(){
        return $this->belongsToMany(Photo::class);
    }

    public function photo()
    {
        return $this->belongsTo(Photo::class,'thumbnail');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
