<?php

namespace App\Http\Controllers;

use App\Models\Post;

class DashboardController extends Controller
{
    /**
     * List posts page
     *
     */
    public function index()
    {
        $posts = Post::where('is_public', 1)->paginate(10);

        return view('dashboard', compact('posts'));
    }
}