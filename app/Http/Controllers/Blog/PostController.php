<?php

namespace App\Http\Controllers\Blog;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use http\QueryString;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show(Post $post)
    {

        return view('blog.show')->with('post', $post);
    }

    public function category(Category $category)
    {
        /*$search = request()->query('search');

        if($search) {

            $posts = $category->post()->where('title', 'LIKE', "%{$search}%")->paginate(1);

        } else {

            $category->post()->paginate(1);
        }*/

        return view('blog.category')
            ->with('category', $category)
            ->with('posts', $category->post()->searched()->paginate(1))
            ->with('categories', Category::all())
            ->with('tags', Tag::all());
    }

    public function tag(Tag $tag)
    {

        return view('blog.tag')
            ->with('tag', $tag)
            ->with('posts', $tag->posts()->searched()->paginate(1))
            ->with('categories', Category::all())
            ->with('tags', Tag::all());
    }
}
