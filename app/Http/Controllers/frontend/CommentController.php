<?php

namespace App\Http\Controllers\frontend;

use App\Article;
use App\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class CommentController extends Controller
{
    public function store(Request $request,$id)
    {
        {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'body' => 'required',
            ],[
                'name.required' => 'نام و نام خانوادگی خود را وارد کنید',
                'body.required' => 'دیدگاه خود را وارد کنید',
                'email.required' => 'پست الکترونیکی خود را وارد کنید',
                'email.email' => 'پست الکترونیکی نامعتبر است',
            ]);
            $comment=new Comment();
            $comment->body = $request->body;
            $comment->name = $request->name;
            $comment->email = $request->email;
            $comment->status = 0;
            $comment->article_id = $id;
            $comment->save();
            Session::flash('success','نظر شما با موفقیت درج گردید و در انتظار تایید مدیر میباشد.');
            return redirect()->to(app('url')->previous()."#commentHash");
        }
    }
    public function reply(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'body' => 'required',
        ],[
            'name.required' => 'نام و نام خانوادگی خود را وارد کنید',
            'body.required' => 'دیدگاه خود را وارد کنید',
            'email.required' => 'پست الکترونیکی خود را وارد کنید',
            'email.email' => 'پست الکترونیکی نامعتبر است',
        ]);
        $article=Article::find($request->input('article_id'));
        if($article){
            $comment=new Comment();
            $comment->body = $request->body;
            $comment->name = $request->name;
            $comment->email = $request->email;
            $comment->status = 0;
            $comment->parent_id=$request->input('parent_id');
            $comment->article_id = $request->input('article_id');
            $comment->save();
            Session::flash('success','نظر شما با موفقیت درج گردید و در انتظار تایید مدیر میباشد.');
        }
        return back();
    }
}
