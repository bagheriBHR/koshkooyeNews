<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function articles()
    {
        return $this->belongsToMany(Article::class)->orderBy('created_at','desc');
    }
    public function children()
    {
        return $this->hasMany(Category::class,'parent_id');
    }
    public function limitRelationship(string $name, int $limit)
    {
        $this->relations[$name] = $this->relations[$name]->slice(0, $limit);
    }
    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive');
    }
}
