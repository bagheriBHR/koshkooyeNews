<?php

namespace App\Http\Controllers\frontend;

use App\Article;
use App\Category;
use App\Commercial;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Tags\Tag;

class NewsController extends Controller
{
    public function show(Request $request,$id,$slug)
    {
        $commercials = Commercial::where('status',0)->orWhere('status',1)->get();
        foreach ($commercials as $commercial){
            if($commercial->status==0){
                if ($commercial->start_date==verta()->formatDate()){
                    $commercial->status=1;
                    $commercial->save();
                }
            }
            if($commercial->status==1){
                if ($commercial->type==1 && $commercial->finish_date==verta()->formatDate()){
                    $commercial->status=2;
                    $commercial->save();
                }
                if ($commercial->type==0 && $commercial->click_count== $commercial->total_click){
                    $commercial->status=2;
                    $commercial->save();
                }
            }
        }
        $activeCommercials = Commercial::where('status',1)->get();

        $article = Article::where('id',$id)->with(['photos','categories','tags','user','comments'=>function($q){
            $q->where('parent_id',null)
                ->where('status',1);
        },'comments.childrenRecursive'=>function($q){
            $q->where('status',1);
        }])->first();
        $article->view_count++;
        $article->save();
        return view('frontend.news.show',compact(['article','activeCommercials']));
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
    public function categoryNews($slug)
    {
        $commercials = Commercial::where('status',0)->orWhere('status',1)->get();
        foreach ($commercials as $commercial){
            if($commercial->status==0){
                if ($commercial->start_date==verta()->formatDate()){
                    $commercial->status=1;
                    $commercial->save();
                }
            }
            if($commercial->status==1){
                if ($commercial->type==1 && $commercial->finish_date==verta()->formatDate()){
                    $commercial->status=2;
                    $commercial->save();
                }
                if ($commercial->type==0 && $commercial->click_count== $commercial->total_click){
                    $commercial->status=2;
                    $commercial->save();
                }
            }
        }
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
            ->paginate(30);
        $group = 'عکس';
        return view('frontend.news.multimedia',compact(['articles','group']));
    }
    public function videos()
    {
        $articles = Article::orderBy('created_at','desc')
            ->where('publish_status',1)
            ->where('type',2)
            ->paginate(30);
        $group= 'فیلم';
        return view('frontend.news.multimedia',compact(['articles','group']));
    }
    public function sounds()
    {
        $articles = Article::orderBy('created_at','desc')
            ->where('publish_status',1)
            ->where('type',3)
            ->paginate(30);
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
