<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CreatePostsRequests;
use App\Http\Requests\UpdatePostRequest;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Middleware\VerifyCategoriesCount;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('verifyCategoryCount')->only(['create', 'store']);
        $this->middleware('verifyTagCount')->only(['create', 'store']);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(!auth()->user()->isAdmin()) {
            $posts = auth()->user()->posts;
        } else if(auth()->user()->isAdmin()) {
            $posts = Post::all();
        }

        $isTrash = false;
        return view('posts.index',compact('posts', 'isTrash'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with('categories', Category::all())->with('tags', Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostsRequests $request)
    {
       // dd($request->all());
       // dd($request->tags);
        //dd('lakshan maduhsnan');
        $image = $request->image->store('posts');
        $post = Post::create([
            'title' => $request->title,
            'category_id' => $request->category,
            'user_id' => auth()->user()->name,
            'description' => $request->description,
            'content' => $request->contents,
            'published_at' => $request->published_at,
            'image' => $image

        ]);



        if($request->tags) {

            $post->tags()->attach($request->tags);
        }

        session()->flash('success', 'Posts added successfully !');

        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //dd($post->id , auth()->user()->posts->pluck('id')->toArray());
        if(!auth()->user()->isAdmin()) {

            if (!in_array($post->id, auth()->user()->posts->pluck('id')->toArray())) {
                return redirect()->back();
            }
        }
       return view('posts.create')->with('post', $post)->with('categories', Category::all())
                                        ->with('tags', Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->only( 'title', 'description', 'published_at');
        $data['category_id'] = $request->input('category');
        $data['content'] = $request->contents;
        //dd($data["category_id"]);

        if($request->hasFile('image')) {

            $image = $request->image->store('posts');

            $post->deleteImage();

            $data['image'] = $image;
        }

        if($request->tags) {
            $post->tags()->sync($request->tags);
        }

        $post->update($data);

        //dd($post->update($data));

        session()->flash('success', 'Post Updated Successfully !');

        return redirect(route('posts.index'));
        /*
        $post->title = $request->title;
        $post->description = $request->description;
        $post->content = $request->contents;
        $post->image = $request->image;
        $post->published_at = $request->published_at;

        $post->save();

        session()->flash('success', 'Post Updated Successfully !');

        return redirect(route('posts.index'));*/
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();

        if($post->trashed()) {
            $post->deleteImage();
            $post->forceDelete();
            session()->flash('success', 'Posts deleted successfully !');

            return redirect(route('trashed-posts.index'));

        } else {

            $post->delete();

            session()->flash('success', 'Posts deleted successfully !');

            return redirect(route('posts.index'));
        }

        session()->flash('success', 'Posts deleted successfully !');

        return redirect(route('posts.index'));
    }
    /**
     * Display list of all trashed posts
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        $posts = Post::onlyTrashed()->get();
        $isTrash=true;
        //dd($trashed);
        return view('posts.index', compact('posts', 'isTrash'));
    }

    public function restorePost($id) {

        $post = Post::withTrashed()->where('id', $id)->firstOrFail();

        $post->restore();

        session()->flash('success', 'Posts restored successfully !');

        return redirect()->back();
    }
}
