<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('update',Auth::user());
        $setting = Setting::first();
        return view('backend.setting.create',compact(['setting']));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('update',Auth::user());
        $request->validate([
            'website_name' => 'required',
            'logo_url' => 'required',
            'about_us' => 'required',
            'contact_us' => 'required',
            'meta_keyword' => 'required',
            'meta_description' => 'required',
        ],[
            'website_name.required' => 'فیلد نام وب سایت الزامی است.',
            'logo_url.required' => 'لوگو وب سایت را انتخاب کنید.',
            'about_us.required' => 'فیلد درباره ما الزامی است.',
            'contact_us.required' => 'فیلد تماس با ما الزامی است.',
            'meta_keyword.required' => 'فیلد کلمات متا الزامی است.',
            'meta_description.required' => 'فیلد توضیحات متا الزامی است.',
        ]);
        $setting = new Setting();
        $setting->website_name = $request->website_name;
        $setting->logo_url = $request->logo_url;
        $setting->is_active = $request->is_active;
        $setting->about_us = $request->about_us;
        $setting->contact_us = $request->contact_us;
        $setting->whatsapp = $request->whatsapp;
        $setting->telegram = $request->telegram;
        $setting->facebook = $request->facebook;
        $setting->twitter = $request->twitter;
        $setting->instagram = $request->instagram;
        $setting->meta_keyword = $request->meta_keyword;
        $setting->meta_description = $request->meta_description;
        $setting->save();

        Session::flash('success', 'ثبت تنظیمات با موفقیت انجام شد.');
        return redirect()->route('admin.home');
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
        $this->authorize('update',Auth::user());
        $request->validate([
            'website_name' => 'required',
            'about_us' => 'required',
            'contact_us' => 'required',
            'meta_keyword' => 'required',
            'meta_description' => 'required',
        ],[
            'website_name.required' => 'فیلد نام وب سایت الزامی است.',
            'about_us.required' => 'فیلد درباره ما الزامی است.',
            'contact_us.required' => 'فیلد تماس با ما الزامی است.',
            'meta_keyword.required' => 'فیلد کلمات متا الزامی است.',
            'meta_description.required' => 'فیلد توضیحات متا الزامی است.',
        ]);
        $setting = Setting::all()->first();
        $setting->website_name = $request->website_name;
        $setting->logo_url = $request->logo_url;
        $setting->is_active = $request->is_active;
        $setting->about_us = $request->about_us;
        $setting->contact_us = $request->contact_us;
        $setting->whatsapp = $request->whatsapp;
        $setting->telegram = $request->telegram;
        $setting->facebook = $request->facebook;
        $setting->twitter = $request->twitter;
        $setting->instagram = $request->instagram;
        $setting->meta_keyword = $request->meta_keyword;
        $setting->meta_description = $request->meta_description;
        $setting->save();

        Session::flash('success', 'ویرایش تنظیمات با موفقیت انجام شد.');
        return redirect()->route('admin.home');
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
}
