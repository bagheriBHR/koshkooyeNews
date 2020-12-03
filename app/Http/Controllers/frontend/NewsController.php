<?php

namespace App\Http\Controllers\frontend;

use App\Article;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Tags\Tag;

class NewsController extends Controller
{
    public function show($id,$slug)
    {
        $article = Article::where('id',$id)->with(['photos','categories','tags','user'])->first();
        return view('frontend.news.show',compact(['article']));
    }

    public function tagNews($slug)
    {
        $tag = Tag::findOrCreate($slug);
        return $tag;
        $id = $tag->id;
        $articles = Article::whereHas('tags',function($q) use($id){
            $q->where('tag_id',$id);
        })->paginate(20);
    }
}
