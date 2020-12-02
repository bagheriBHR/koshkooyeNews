<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PhotoController extends Controller
{
    public function uploadThumbnail(Request $request)
    {
        $photo = $request->file('file');

        $name = time() . $photo->getClientOriginalName();
        $small_name = 'small_'.time() . $photo->getClientOriginalName();
        $medium_name = 'medium_'.time() . $photo->getClientOriginalName();
        $large_name = 'large_'.time() . $photo->getClientOriginalName();

        Storage::disk('public')->putFileAs('photos/articles', $photo, $name);

        $small_resize = Image::make($request->file('file'))
            ->resize(100, null, function ($constraint) { $constraint->aspectRatio(); } );
        Storage::disk('public')->put('photos/articles/thumbnail/'.$small_name,$small_resize);

        $medium_resize = Image::make($request->file('file'))
            ->resize(200, null, function ($constraint) { $constraint->aspectRatio(); } );
        Storage::disk('public')->put('photos/articles/thumbnail/'.$medium_name,$medium_resize);

        $large_resize = Image::make($request->file('file'))
            ->resize(300, null, function ($constraint) { $constraint->aspectRatio(); } );
        Storage::disk('public')->put('photos/articles/thumbnail/'.$large_name,$large_resize);

        return response()->json(['url' => $name]);
    }
    public function upload(Request $request)
    {
        $photo = $request->file('file');
        $name = time() . $photo->getClientOriginalName();
        Storage::disk('public')->putFileAs('photos/avatar', $photo, $name);
        return response()->json(['url' => $name]);
    }
    public function uploadBanner(Request $request)
    {
        $photo = $request->file('file');
        $name = time() . $photo->getClientOriginalName();
        Storage::disk('public')->putFileAs('photos/commercials', $photo, $name);
        return response()->json(['url' => $name]);
    }
    public function uploadGallery(Request $request)
    {
        $photo = $request->file('file');
        $name = time() . $photo->getClientOriginalName();
        Storage::disk('public')->putFileAs('photos/gallery', $photo, $name);

        $photo = new Photo();
        $photo->path = $name;
        $photo->save();
        return response()->json(['url' => $photo->id]);
    }
    public function ck_upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('images'), $fileName);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('images/' . $fileName);
            $msg = 'تصویر با موفقیت بارگذاری شد.';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }

    }
}
