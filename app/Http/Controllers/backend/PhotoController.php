<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Photo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PhotoController extends Controller
{
    public function uploadThumbnail(Request $request)
    {
        $photo = $request->file('file');

        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        $imagePath = "/photos/thumbnail/{$year}/{$month}/";

        $name = time() . $photo->getClientOriginalName();
        $small_name = 'small_'.$name;
        $medium_name = 'medium_'.$name;
        $large_name = 'large_'.$name;

        $small_resize = Image::make($request->file('file'))
            ->resize(480, 270, function ($constraint) { $constraint->aspectRatio(); } )
            ->encode('jpg');
        Storage::disk('public')->put($imagePath.$small_name,$small_resize);

        $medium_resize = Image::make($request->file('file'))
            ->resize(600, 338, function ($constraint) { $constraint->aspectRatio(); } )
            ->encode('jpg');
        Storage::disk('public')->put($imagePath.$medium_name,$medium_resize);

        $large_resize = Image::make($request->file('file'))
            ->resize(800, 450, function ($constraint) { $constraint->aspectRatio(); } )
            ->encode('jpg');
        Storage::disk('public')->put($imagePath.$large_name,$large_resize);

        $photo = new Photo();
        $photo->originalName = $name;
        $photo->path = $imagePath;
        $photo->save();
        return response()->json(['url' => $photo->id]);
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

        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        $imagePath = "/photos/commercials/{$year}/{$month}/";

        Storage::disk('public')->putFileAs($imagePath, $photo, $name);

        $photo = new Photo();
        $photo->originalName = $request->file('file')->getClientOriginalExtension();
        $photo->path = $imagePath.$name;
        $photo->save();
        return response()->json(['url' => $photo->id]);
    }
    public function uploadGallery(Request $request)
    {
        $photo = $request->file('file');
        $name = time() . $photo->getClientOriginalName();

        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        $imagePath = "/photos/gallery/{$year}/{$month}/";

        $medium_resize = Image::make($request->file('file'))
            ->resize(600, 338, function ($constraint) { $constraint->aspectRatio(); } )
            ->encode('jpg');
        Storage::disk('public')->put($imagePath.$name,$medium_resize);

        $photo = new Photo();
        $photo->path = $imagePath;
        $photo->originalName = $name;
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

            $year = Carbon::now()->year;
            $month = Carbon::now()->month;
            $imagePath = "/images/ckeditor/{$year}/{$month}/";
            $request->file('upload')->move(public_path($imagePath), $fileName);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset($imagePath . $fileName);
            $msg = 'تصویر با موفقیت بارگذاری شد.';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }

    }
}
