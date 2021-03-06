<?php

namespace App\Http\Controllers\backend;

use App\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CommentController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny',Auth::user());
        $comments = Comment::orderBy('status','asc')->orderBy('created_at','desc')->paginate(20);
        return view('backend.comment.list',compact(['comments']));
    }

        public function action(Request $request,$id)
    {
        $this->authorize('viewAny',Auth::user());
        $comment=Comment::find($id);
        if($request->input('action')=='publish'){
            $comment->status=1;
            $comment->save();
            return redirect('/admin/comment')->with('success', 'نظر تایید شد.');;
        }
        else{
            $comment->status=0;
            $comment->save();
            return redirect('/admin/comment')->with('danger', 'نظر تایید نشد.');;
        }
    }

    public function show($id)
    {
        $this->authorize('viewAny',Auth::user());
        $comment = Comment::where('id',$id)->first();
        return view('backend.comment.show',compact(['comment']));
    }
}
