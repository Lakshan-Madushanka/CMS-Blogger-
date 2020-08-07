<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Http\Requests\UpdateTagRequest;
use Illuminate\Http\Request;

use App\Http\Requests\CreateTagRequest;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tags.index')->with('tags', Tag::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tags.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTagRequest $request)
    {

        Tag::create([

            'name' => $request->name
        ]);

        session()->flash('success', 'Tag added successfully !');
        return redirect(route('tags.index'));
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
    public function edit(Tag $Tag)
    {
        return view('tags.create')->with('Tag', $Tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTagRequest $request, Tag $Tag)
    {
        $Tag->name = $request->name;

        $Tag->save();

        session()->flash('success', 'Tag Updated Successfully !');

        return redirect(route('categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $Tag)
    {
        if($Tag->posts->count() > 0) {

            session()->flash('error', 'Can not delete, tag you selected  has
             associate with posts!');

            return redirect()->back();
        }
        $Tag->delete();

        session()->flash('success', 'Tag deleted successfully !');

        return redirect(route('tags.index'));
    }
}
