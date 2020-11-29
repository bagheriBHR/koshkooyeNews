<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function upload(Request $request)
    {
        $video = $request->file('file');
        $name = time() . $video->getClientOriginalName();
        Storage::disk('public')->putFileAs('videos', $video, $name);
        return response()->json(['url' => $name]);
    }
}
