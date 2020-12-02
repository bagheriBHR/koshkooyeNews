<?php

namespace App\Http\Controllers\backend;

use App\Article;
use App\Commercial;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $activeUsers = User::where('status',1)->count();
        $deactiveUsers = User::where('status',0)->count();
        $activeArticles = Article::where('publish_status',1)->count();
        $totalArticles = Article::all()->count();
        $activeCommercials = Commercial::where('status',1)->count();
        $totalCommercials = Commercial::all()->count();
        return view('backend.dashboard.list',compact(['activeUsers','deactiveUsers','activeArticles','totalArticles','activeCommercials','totalCommercials']));
    }
}
