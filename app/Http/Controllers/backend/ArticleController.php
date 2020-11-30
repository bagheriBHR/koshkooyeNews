<?php

namespace App\Http\Controllers\backend;

use App\Article;
use App\category;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Photo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::with(['categories','user','tags'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        return view('backend.article.list',compact(['articles']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = category::all();
        $authors = User::where('is_author',1)->get();
        return view('backend.article.create',compact(['categories','authors']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        $article = new Article();
        $article->title = $request->title;
        if($request->slug){
            $article->slug= make_slug($request->slug);
        }else{
            $article->slug= make_slug($request->title);
        }
        $article->roo_titr = $request->roo_titr;
        $article->body = $request->body;
        $article->summery = $request->summery;
        $article->user_id = Auth::id();
        $article->author_id = $request->author_id;
        $article->is_carousel = $request->is_carousel;
        $article->publish_status = $request->publish_status;
        if($request->publish_status==1){
            $article->publish_date = new \DateTime();
        }
        $article->thumbnail = $request->thumbnail;
        $article->video_url = $request->video_url;
        $article->save();
        $article->categories()->sync($request->category_id);

        if($request->image_url) {
            $images = explode(',', $request->image_url[0]);
            $article->photos()->sync($images);
        }

        $tags = explode('،',$request->tag);
        $article->attachTags($tags);

        Session::flash('success', 'خبر با موفقیت اضافه شد.');
        return redirect()->route('article.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $authors = User::where('is_author',1)->get();
        $article = Article::where('id',$id)->with(['categories','user','tags','photos'])->first();
        return view('backend.article.update',compact(['article','categories','authors']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArticleRequest $request, $id)
    {
        $article = Article::find($id);
        $article->title = $request->title;
        if($request->slug){
            $article->slug= make_slug($request->slug);
        }else{
            $article->slug= make_slug($request->title);
        }
        $article->roo_titr = $request->roo_titr;
        $article->body = $request->body;
        $article->summery = $request->summery;
        $article->user_id = Auth::id();
        $article->author_id = $request->author_id;
        $article->is_carousel = $request->is_carousel;
        $article->publish_status = $request->publish_status;
        if($request->publish_status==1 && $article->publish_date==''){
            $article->publish_date = new \DateTime();
        }
        $article->thumbnail = $request->thumbnail;
        $article->video_url = $request->video_url;
        $article->save();
        $article->categories()->sync($request->category_id);

        if($request->image_url){
            $images = explode(',',$request->image_url[0]);
            $article->photos()->sync($images);
        }

        if($request->tag){
            $tags = explode('،',$request->tag);
            $article->attachTags($tags);
        }

        Session::flash('success', 'خبر با موفقیت ویرایش شد.');
        return redirect()->route('article.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        $article->delete();

        Session::flash('success', 'خبر با موفقیت حذف شد.');
        return redirect()->route('article.index');
    }

    public function search(Request $request)
    {
        if($request->search == null){
            Session::flash('warning', 'عبارت مورد نظر خود را وارد کنید.');
            return redirect()->route('user.index');
        }else{
            $articles = Article::where('title', 'LIKE', '%' . $request->search . '%')
            ->orWhere('body', 'LIKE', '%' . $request->search . '%')
            ->orWhere('roo_titr', 'LIKE', '%' . $request->search . '%')->paginate(10);
            return view('backend.article.list',compact(['articles']));
        }
    }

    public function action(Request $request,$id)
    {
        $article = Article::find($id);
        if($request->action=='publish'){
            $article->publish_status = 1;
        }else{
            $article->publish_status = 2;
        }
        $article->save();
        return back();
    }
}
