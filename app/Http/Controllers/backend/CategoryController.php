<?php

namespace App\Http\Controllers\backend;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('created_at', 'desc')->paginate(20);
        return view('backend.category.list',compact(['categories']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {

        $category=new Category();
        $category->name=$request->name;
        if($request->slug){
            $category->slug =make_slug($request->slug);
        }else{
            $category->slug =make_slug($request->name);
        }
        $category->save();
        Session::flash('success','دسته بندی با موفقیت ثبت گردید.');
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('update',Auth::user());

        $category = Category::find($id);
        return view('backend.category.edit',compact(['category']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        $this->authorize('update',Auth::user());
        $category= Category::find($id);
        $category->name=$request->name;
        if($request->slug){
            $category->slug =make_slug($request->slug);
        }else{
            $category->slug =make_slug($request->name);
        }
        $category->save();
        Session::flash('success','دسته بندی با موفقیت بروزرسانی گردید.');
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete',Auth::user());
        $category = Category::find($id);
//        if(count($category->posts)>0 || count($category->courses)>0){
//            Session::flash('error','دسته ' .$category->name.' دارای زیر مجموعه است و قابل حذف نیست. ');
//            return redirect()->route('category.index');
//        }
        $category->delete();
        Session::flash('danger','دسته بندی ' .$category->name.' '.'با موفقیت حذف گردید. ');
        return redirect()->route('category.index');
    }
}
