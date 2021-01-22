<?php

namespace App\Http\Controllers\frontend;

use App\Article;
use App\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function store(Request $request,$id)
    {
        $validator = Validator::make($request->all() , [
            'name' => 'required',
            'email' => 'required|email',
            'body' => 'required',
        ],[
            'name.required' => 'نام و نام خانوادگی خود را وارد کنید',
            'body.required' => 'نظر خود را وارد کنید',
            'email.required' => 'پست الکترونیکی خود را وارد کنید',
            'email.email' => 'پست الکترونیکی نامعتبر است',
        ]);

        if($validator->fails()) {
            return redirect()->to(app('url')->previous()."#commentHash")->withErrors($validator)->withInput();

        }

            $comment=new Comment();
            $comment->body = $request->body;
            $comment->name = $request->name;
            $comment->email = $request->email;
            $comment->status = 0;
            $comment->article_id = $id;
            $comment->save();
            Session::flash('commentsuccess','نظر شما با موفقیت درج گردید و در انتظار تایید مدیر است.');
            return redirect()->to(app('url')->previous()."#commentHash");

    }
    public function reply(Request $request)
    {
        $validator = Validator::make($request->all() , [
            'rname' => 'required',
            'remail' => 'required|email',
            'rbody' => 'required',
        ],[
            'rname.required' => 'نام و نام خانوادگی خود را وارد کنید',
            'rbody.required' => 'نظر خود را وارد کنید',
            'remail.required' => 'پست الکترونیکی خود را وارد کنید',
            'remail.email' => 'پست الکترونیکی نامعتبر است',
        ]);

        if($validator->fails()) {
            Session::flash('replydanger','برای ارسال نظر خود، همه فیلد ها را کامل کنید.');
            return redirect()->to(app('url')->previous()."#replyHash")->withErrors($validator)->withInput();

        }
        $article=Article::find($request->input('article_id'));
        if($article){
            $comment=new Comment();
            $comment->body = $request->rbody;
            $comment->name = $request->rname;
            $comment->email = $request->remail;
            $comment->status = 0;
            $comment->parent_id=$request->input('parent_id');
            $comment->article_id = $request->input('article_id');
            $comment->save();
            Session::flash('replysuccess','نظر شما با موفقیت درج گردید و در انتظار تایید مدیر است.');
        }
        return redirect()->to(app('url')->previous()."#replyHash");
    }
}
