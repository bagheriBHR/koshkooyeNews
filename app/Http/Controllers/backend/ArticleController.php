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
use phpDocumentor\Reflection\DocBlock\Tag;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::with(['categories','user','tags','photo'])
            ->where('publish_status',0)
            ->orWhere('publish_status',1)
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
        $categories = Category::where('parent_id',null)->get();
        $subcategories = Category::whereNotNull('parent_id')->get();
        return view('backend.article.create',compact(['categories','subcategories']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        if($request->type==1 && $request->image_url[0]==null){
            Session::flash('danger', 'فیلد گالری تصاویر برای نوع خبر عکس الزامی است.');
            return back();
        }elseif(($request->type==2 || $request->type==3) && $request->video_url==null){
            Session::flash('danger', 'فیلد آپلود فایل برای نوع خبر ویدیویی یا صوتی الزامی است.');
            return back();
        }else{
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
            $article->type = $request->type;
            $article->user_id = Auth::id();
            $article->reporter = $request->reporter;
            $article->is_carousel = $request->is_carousel;
            $article->publish_status = $request->publish_status;
            $article->photographer = $request->photographer;
            $article->media_source = $request->media_source;
            if($request->publish_status==1){
                $article->publish_date = new \DateTime();
            }
            $article->thumbnail = $request->thumbnail;
            $article->video_url = $request->video_url;
            $article->save();
            $article->categories()->attach($request->category_id);
            $article->categories()->attach($request->subcategory_id);

            if($request->image_url[0]!=null) {
                $images = explode(',', $request->image_url[0]);
                $article->photos()->sync($images);
            }

            $tags = explode('،',$request->tag);
            $article->attachTags($tags);

            Session::flash('success', 'خبر با موفقیت اضافه شد.');
            return redirect()->route('article.index');

        }
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
        $categories=Category::where('parent_id',null)->get();
        $article = Article::where('id',$id)->with(['categories','user','tags','photos'])->first();
        $tags = $article->tags->pluck('name');
        $subcategories = Category::whereNotNull('parent_id')->get();
        return view('backend.article.update',compact(['article','categories','tags','subcategories']));
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
        if($request->type==1 && $request->image_url[0]==null){
            Session::flash('danger', 'فیلد گالری تصاویر برای نوع خبر عکس الزامی است.');
            return back();
        }elseif(($request->type==2 || $request->type==3) && $request->video_url==null){
            Session::flash('danger', 'فیلد آپلود فایل برای نوع خبر ویدیویی یا صوتی الزامی است.');
            return back();
        }else {
            $article = Article::find($id);
            $article->title = $request->title;
            if ($request->slug) {
                $article->slug = make_slug($request->slug);
            } else {
                $article->slug = make_slug($request->title);
            }
            $article->roo_titr = $request->roo_titr;
            $article->body = $request->body;
            $article->summery = $request->summery;
            $article->type = $request->type;
            $article->user_id = Auth::id();
            $article->reporter = $request->reporter;
            $article->photographer = $request->photographer;
            $article->media_source = $request->media_source;
            $article->is_carousel = $request->is_carousel;
            $article->publish_status = $request->publish_status;
            if ($request->publish_status == 1 && $article->publish_date == '') {
                $article->publish_date = new \DateTime();
            }
            $article->thumbnail = $request->thumbnail;
            $article->video_url = $request->video_url;
            $article->save();
            $article->categories()->sync($request->category_id);
            if($request->subcategory_id){
                $article->categories()->attach($request->subcategory_id);
            }
            if ($request->image_url[0] != null) {
                $images = explode(',', $request->image_url[0]);
                $article->photos()->sync($images);
            }

            if ($request->tag) {
                $tags = explode('،', $request->tag);
                $article->attachTags($tags);
            }

            if ($request->removedTags) {
                $article->detachTags($request->removedTags);
            }

            Session::flash('success', 'خبر با موفقیت ویرایش شد.');
            return redirect()->route('article.index');
        }
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
        $this->authorize('delete',$article);
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
            if ($article->publish_date == '') {
                $article->publish_date = new \DateTime();
            }
        }else{
            $article->publish_status = 2;
        }
        $article->save();
        return redirect()->route('article.index');
    }
    public function articleList(Request $request,$id)
    {
        switch($request->input('filter')) {
            case 'user':
                $articles = Article::with(['categories','user','tags'])
                    ->where('id',$id)
                    ->orderBy('created_at', 'desc')
                    ->paginate(20);
                break;
            case 'category' :
                $articles = Article::whereHas('categories',function($q) use($id){
                    $q->where('category_id',$id);
                })->paginate(20);
                break;
            case 'tag':
                $articles = Article::whereHas('tags',function($q) use($id){
                    $q->where('tag_id',$id);
                })->paginate(20);
                break;
        }
        return view('backend.article.list',compact(['articles']));
    }
    public function filter(Request $request)
    {
        $this->authorize('create', Auth::user());
        switch ($request->input('filter')) {
            case 'active':
                $articles =Article::where('publish_status', 1)->paginate(10);
                break;
            case 'deactive':
                $articles =Article::where('publish_status', 0)->paginate(10);
                break;
            case 'archive':
                $articles =Article::where('publish_status', 2)->paginate(10);
                break;
            case 'is_carousel':
                $articles =Article::where('is_carousel', 1)->paginate(10);
                break;
            case 'isnot_carousel':
                $articles =Article::where('is_carousel', 0)->paginate(10);
                break;
        }
        return view('backend.article.list', compact(['articles']));
    }
}
