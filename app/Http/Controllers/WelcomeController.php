<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{

    public function index()
    {

        //dd(request()->query('search'));
        /*$search = request()->query('search');
        if ($search) {
            $posts = Post::where('title', 'LIKE', "%{$search}%")->paginate(1);
        } else {
            $posts = Post::paginate(2);
        }*/

        // query scope used

        return view('welcome')
            ->with('posts', Post::searched()->paginate(2))
            ->with('categories', Category::all())
            ->with('tags', Tag::all());

    }
}
