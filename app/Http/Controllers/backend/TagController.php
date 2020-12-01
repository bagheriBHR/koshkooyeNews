<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Tags\Tag;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::paginate(20);
        return view('backend.tag.list',compact(['tags']));
    }
}
