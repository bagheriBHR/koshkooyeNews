<?php

namespace App\Http\Controllers\backend;

use App\Article;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateUserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $this->authorize('viewAny',Auth::user());
        $users = User::with(['articles'])->orderBy('created_at','desc')->paginate(10);
        $firstUser = User::first();
        return view('backend.user.list',compact(['users','firstUser']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create',Auth::user());
        $user = Auth::user();
        return view('backend.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create',Auth::user());
        $validator = Validator::make($request->all() , [
            'first_name'=>'required',
            'last_name'=>'required',
            'username'=>'required|unique:users',
            'password'=>'required|min:8',
            'email'=>'required|email|unique:users',
            'role'=>'required',
        ],[
            'role.required'=>'نقش کاربر را مشخص کنید.'
        ]);
        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $roles = $request->input('role');
        $user = new User();
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password =Hash::make($request->input('password')) ;
        $user->avatar = $request->input('avatar');
        $user->status = $request->input('status');
        foreach ($roles as $role){
            $user->$role = 1;
        }
        $user->save();

        Session::flash('success', 'ثبت نام کاربر با موفقیت انجام شد.');
        return redirect()->route('user.index');
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
        $this->authorize('create',Auth::user());
        $user = User::whereId($id)->first();
        return view('backend.user.edit',compact(['user']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $this->authorize('create',Auth::user());
        $roles = $request->input('role');
        $user = User::find($id);
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->avatar = $request->input('avatar');
        $user->status = $request->input('status');
        foreach ($roles as $role){
            $user->$role = 1;
        }
        $user->save();

        Session::flash('success', 'مشخصات کاربر با موفقیت ویرایش شد.');
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('create',Auth::user());
        $user = User::find($id);
        if (count($user->articles)>0){
            Session::flash('danger', 'کاربر دارای مطلب می باشد و قابل حذف نیست.');
            return redirect()->route('user.index');
        }
        $user->delete();
        Session::flash('danger', 'کاربر با موفقیت حذف گردید.');
        return redirect()->route('user.index');
    }

    public function search(Request $request)
    {
        $this->authorize('viewAny',Auth::user());
        if($request->search == null){
            Session::flash('warning', 'نام خانوادگی کاربر را وارد کنید.');
            return redirect()->route('user.index');
        }else{
            $firstUser = User::first();
            $users = User::where('last_name', 'LIKE', '%' . $request->search . '%')->paginate(10);
            return view('backend.user.list',compact(['users','firstUser']));
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
        $firstUser = User::first();
        return view('backend.user.list',compact(['users','firstUser']));
    }

}
