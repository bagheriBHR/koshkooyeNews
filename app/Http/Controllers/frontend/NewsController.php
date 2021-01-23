<?php

namespace App\Http\Controllers\frontend;

use App\Article;
use App\Category;
use App\Comment;
use App\Commercial;
use App\Http\Controllers\Controller;
use App\Traits\CommercialTrait;
use Illuminate\Http\Request;
use Spatie\Tags\Tag;

class NewsController extends Controller
{
    use CommercialTrait;
    public function show(Request $request,$id,$slug)
    {
        $this->handleCommercials();
        $activeCommercials = Commercial::where('status',1)->get();

        $article = Article::where('id',$id)->with(['photos','categories','tags','user','comments'=>function($q){
            $q->where('parent_id',null)
                ->where('status',1);
        },'comments.childrenRecursive'=>function($q){
            $q->where('status',1);
        }])->first();
        $comment_count = Comment::where('article_id',$id)->where('status',1)->count();
        $article->view_count++;
        $article->save();
        return view('frontend.news.show',compact(['article','activeCommercials','comment_count']));
    }

    public function tagNews($slug)
    {
        $tag = Tag::findOrCreate($slug);
        $id = $tag->id;
        $articles = Article::whereHas('tags',function($q) use($id){
            $q->where('tag_id',$id);
        })->paginate(20);
        $categories = Category::where('parent_id',null)->whereHas('articles')->get();
        return view('frontend.news.search',compact('articles','categories','tag'));
    }
    public function categoryNews($slug)
    {
        $this->handleCommercials();
        $activeCommercials = Commercial::where('status',1)->get();

        $category = Category::where('slug',$slug)->first();
        $articles = Article::whereHas('categories',function($q) use($category){
            $q->where('category_id',$category->id);
        })->orderBy('created_at','desc')
            ->where('publish_status',1)
            ->paginate(30);
        return view('frontend.news.category',compact(['articles','category','activeCommercials']));
    }
    public function photos()
    {
        $articles = Article::orderBy('created_at','desc')
            ->where('publish_status',1)
            ->where('type',1)
            ->paginate(28);
        $group = 'عکس';
        return view('frontend.news.multimedia',compact(['articles','group']));
    }
    public function videos()
    {
        $articles = Article::orderBy('created_at','desc')
            ->where('publish_status',1)
            ->where('type',2)
            ->paginate(28);
        $group= 'فیلم';
        return view('frontend.news.multimedia',compact(['articles','group']));
    }
    public function sounds()
    {
        $articles = Article::orderBy('created_at','desc')
            ->where('publish_status',1)
            ->where('type',3)
            ->paginate(28);
        $group= 'صوت';
        return view('frontend.news.multimedia',compact(['articles','group']));
    }

    public function aboutus($name)
    {
        if($name == 'درباره_ما'){
            $page = 'about';
        }else{
            $page = 'contact';
        }
        return view('frontend.info.show',compact(['page']));
    }

    public function printNews($id)
    {
        $article = Article::find($id);
        return view('frontend.news.print',compact(['article']));
    }
}
