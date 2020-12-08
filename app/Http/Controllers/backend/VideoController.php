<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function upload(Request $request)
    {
        $video = $request->file('file');
        $name = time() . $video->getClientOriginalName();

        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        $videoPath = "/videos/{$year}/{$month}/";

        Storage::disk('public')->putFileAs($videoPath, $video, $name);
        return response()->json(['url' => $videoPath.$name]);
    }
}
