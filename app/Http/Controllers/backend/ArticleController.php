<?php

namespace App\Http\Controllers\backend;

use App\Article;
use App\category;
use App\Http\Controllers\Controller;
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
    public function store(Request $request)
    {
        return $request;
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search(Request $request)
    {
        $this->authorize('viewAny',Auth::user());
        if($request->search == null){
            Session::flash('warning', 'نام خانوادگی کاربر را وارد کنید.');
            return redirect()->route('user.index');
        }else{
            $users = User::where('last_name', 'LIKE', '%' . $request->search . '%')->paginate(10);
            return view('backend.user.list',compact(['users']));
        }
    }
    public function filter(Request $request)
    {
        $this->authorize('viewAny',Auth::user());
        switch($request->input('filter')){
            case 'admin':
                $users = User::where('is_admin',1)->paginate(10);
                break;
            case 'author':
                $users = User::where('is_author',1)->paginate(10);
                break;
            case 'editor':
                $users = User::where('is_editor',1)->paginate(10);
                break;
            case 'active':
                $users = User::where('status',1)->paginate(10);
                break;
            case 'deactive':
                $users = User::where('status',0)->paginate(10);
                break;
        }
        return view('backend.user.list',compact(['users']));
    }

}
