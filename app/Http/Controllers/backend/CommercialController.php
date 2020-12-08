<?php

namespace App\Http\Controllers\backend;

use App\Commercial;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CommercialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('create', Auth::user());
        $commercials = Commercial::where('status',0)->orWhere('status',1)->orderBy('created_at','desc')->paginate(20);
        return view('backend.commercial.list', compact(['commercials']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.commercial.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Auth::user());
        $request->validate([
            'title' => 'required',
            'banner' => 'required',
            'type' => 'required',
        ], [
            'title.required' => 'فیلد عنوان تبلیغ الزامی است.',
            'url.required' => 'فیلد بنر تبلیغاتی الزامی است.',
            'type.required' => 'فیلد نوع سرویس دهی الزامی است.',
        ]);
        $activeCommercials = Commercial::where('status',1)->count();
        if($activeCommercials>10){
            Session::flash('success', '10 تبلیغ فعال وجود دارد.امکان درج تبلیغ وجود ندارد.');
            return redirect()->route('commercial.index');
        }
        $commercial = new Commercial();
        $commercial->title = $request->title;
        $commercial->url = $request->url;
        $commercial->banner = $request->banner;
        $commercial->status = $request->status;
        $commercial->type = $request->type;
        $commercial->total_click = $request->total_click;
        if($request->type == 0){
            $commercial->start_date = $request->start_date_click;
        }else{
            $commercial->start_date = $request->start_date;
        }
        $commercial->finish_date = $request->finish_date;
        $commercial->status = 0;
        $commercial->save();

        Session::flash('success', 'درج تبلیغ با موفقیت انجام شد.');
        return redirect()->route('commercial.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $commercial = Commercial::find($id);
        return view('backend.commercial.edit', compact(['commercial']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('create', Auth::user());
        $request->validate([
            'title' => 'required',
            'type' => 'required',
        ], [
            'title.required' => 'فیلد عنوان تبلیغ الزامی است.',
            'type.required' => 'فیلد نوع سرویس دهی الزامی است.',
        ]);

        $commercial = Commercial::find($id);
        $commercial->title = $request->title;
        $commercial->url = $request->url;
        $commercial->banner = $request->banner;
        $commercial->status = $request->status;
        $commercial->type = $request->type;
        $commercial->total_click = $request->total_click;
        if($request->type == 0){
            $commercial->start_date = $request->start_date_click;
        }else{
            $commercial->start_date = $request->start_date;
        }
        $commercial->finish_date = $request->finish_date;
        $commercial->status = 0;
        $commercial->save();

        Session::flash('success', 'ویرایش تبلیغ با موفقیت انجام شد.');
        return redirect()->route('commercial.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', Auth::user());
        $commercial = Commercial::find($id);
        $commercial->delete();
        Session::flash('danger', 'تبلیغ ' . $commercial->title . ' ' . 'با موفقیت حذف گردید. ');
        return redirect()->route('commercial.index');
    }

    public function search(Request $request)
    {
        $this->authorize('create', Auth::user());
        if ($request->search == null) {
            Session::flash('warning', 'عنوان تبلیغ را وارد کنید.');
            return redirect()->route('commercial.index');
        } else {
            $commercials = Commercial::where('title', 'LIKE', '%' . $request->search . '%')->paginate(10);
            return view('backend.commercial.list', compact(['commercials']));
        }
    }

    public function filter(Request $request)
    {
        $this->authorize('create', Auth::user());
        switch ($request->input('filter')) {
            case 'active':
                $commercials = Commercial::where('status', 1)->paginate(10);
                break;
            case 'deactive':
                $commercials = Commercial::where('status', 0)->paginate(10);
                break;
            case 'archive':
                $commercials = Commercial::where('status', 2)->paginate(10);
                break;
            case 'click_count':
                $commercials = Commercial::where('type', 0)->paginate(10);
                break;
            case 'date':
                $commercials = Commercial::where('type', 1)->paginate(10);
                break;
        }
        return view('backend.commercial.list', compact(['commercials']));
    }

}
