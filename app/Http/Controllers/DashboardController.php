<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;


class DashboardController extends Controller
{
    public function index(){
        $blogs = Blog::where('user_id', auth()->user()->id)->whereNotIn('status_id', [3])->get();
        return view('dashboard', compact('blogs'));
    }
}
