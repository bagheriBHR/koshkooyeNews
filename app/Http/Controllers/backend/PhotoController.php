<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    public function upload(Request $request)
    {
        $photo = $request->file('file');
        $name = time() . $photo->getClientOriginalName();
        Storage::disk('public')->putFileAs('photos/avatar', $photo, $name);
        return response()->json(['url' => $name]);
    }
}
