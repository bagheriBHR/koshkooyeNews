<?php

namespace App\Http\Controllers\backend;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with(['childrenRecursive'])
            ->where('parent_id','=',null)
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        return view('backend.category.list',compact(['categories']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::with(['childrenRecursive'])
            ->where('parent_id',null)
            ->get();
        return view('backend.category.create',compact(['categories']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->input('slug')){
            $request->merge(['slug'=>make_slug($request->input('slug'))]);
        }else{
            $request->merge(['slug'=>make_slug($request->input('name'))]);
        }

        $validator = Validator::make($request->all() , [
            'name'=>'required ',
            'slug' => 'unique:categories',
        ],[
            'name.required' => 'لطفا نام دسته بندی را وارد کنید',
            'slug.unique'=>' نام مستعار دسته بندی باید یکتا باشد.',
        ]);
        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $category=new Category();
        $category->name=$request->name;
        if($request->slug){
            $category->slug =make_slug($request->slug);
        }else{
            $category->slug =make_slug($request->name);
        }
        $category->parent_id = $request->parent_id;
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
        $categories=Category::with(['childrenRecursive'])
            ->where('parent_id',null)
            ->get();
        $category = Category::find($id);
        $this->authorize('update',$category);
        return view('backend.category.edit',compact(['category','categories']));
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
        $category= Category::find($id);
        $this->authorize('update',$category);
        $category->name=$request->name;
        if($request->slug){
            $category->slug =make_slug($request->slug);
        }else{
            $category->slug =make_slug($request->name);
        }
        $category->parent_id = $request->parent_id;
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
        $category=Category::with('childrenRecursive')->where('id',$id)->first();
        $this->authorize('delete',$category);
        if(count($category->childrenRecursive)>0){
            Session::flash('danger','دسته ' .$category->name.' دارای زیر دسته است و قابل حذف نیست. ');
            return redirect()->route('category.index');
        }
        if(count($category->articles)>0){
            Session::flash('danger','دسته ' .$category->name.' دارای زیر مجموعه است و قابل حذف نیست. ');
            return redirect()->route('category.index');
        }
        $category->delete();
        Session::flash('danger','دسته بندی ' .$category->name.' '.'با موفقیت حذف گردید. ');
        return redirect()->route('category.index');
    }
}
