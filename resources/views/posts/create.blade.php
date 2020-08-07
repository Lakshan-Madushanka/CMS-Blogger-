@extends('layouts.app');

@section('content')

    <div class="container">

        <div class="card card-default">
            <div class="card-header">
                {{isset($post)? "Edit Post" : "Create Post"}}
            </div>

            <div class="card-body">
                <form action="{{isset($post) ? route('posts.update', $post->id) : route('posts.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(isset($post))
                        @method('PATCH')
                    @endif

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" id="title" class="form-control" name="title" value="{{isset($post) ? $post->title : ''}}">
                        @error('title')
                        <div class="text-center text-danger mt-2">{{$message}}</div>
                        @enderror
                    </div>

                    @if($categories->count() > 0)
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select name="category" id="category" class="form-control">
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}"
                                        @if(isset($post))
                                            @if($post->category_id === $category->id)
                                                selected
    =                                       @endif
                                        @endif
                                            >
                                        {{$category->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    @if($tags->count() > 0)
                    <div class="form-group">
                        <label for="tags">Tags</label>
                        <select name="tags[]" id="tags" class="form-control js-example-basic-multiple" multiple>
                            @foreach($tags as $tag)
                                <option value="{{$tag->id}}"
                                        @if(isset($post))
                                            @if($post->hasTag($tag->id))
                                                selected
                                            @endif
                                        @endif
                                >
                                    {{$tag->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                        @error('tags')
                        <div class="text-center text-danger mt-2">{{$message}}</div>
                        @enderror
                    @endif



                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea type="text" cols="5" rows="5" id="description" class="form-control" name="description">
                                {{isset($post) ? $post->description : ''}}
                        </textarea>
                        @error('description')
                        <div class="text-center text-danger mt-2">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="content">Content</label>
{{--                        <textarea type="text" cols="5" rows="5" id="content" class="form-control" name="contents"></textarea>--}}
                        <input id="contents" type="hidden" name="contents" value="{{isset($post) ? $post->content : ''}}">
                        <trix-editor input="contents"></trix-editor>
                        @error('contents')
                        <div class="text-center text-danger mt-2">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="published_at">Published at</label>
                        <input type="text" id="published_at" name="published_at" class="form-control" value="{{isset($post) ? $post->published_at : ''}}">
                    </div>
                    @if(isset($post))
                    <div class="form-group">
                        <img src="{{asset('/storage/'. $post->image)}}" alt="post image" width="750">
                    </div>
                     @endif

                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" id="image" class="form-control" name="image">
                        @error('image')
                        <div class="text-center text-danger mt-2">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group mt-5">
                        <button type="submit" class="btn btn-success form-control">
                            {{isset($post)? "Edit Post" : "Add Post"}}
                            </button>
                    </div>
                </form>
            </div>

        </div>

    </div>

@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>


    <script>
        // prevent trix editor accept attachments
        addEventListener('trix-file-accept', (event) => {
            event.preventDefault();
        });

        $('.trix-button-group--file-tools').css('display', 'none')

        // data picker
        flatpickr('#published_at', {
            enableTime: true,
            enableSeconds: true
        })

        //multi select
        $('.js-example-basic-multiple').select2();

    </script>

@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />



@endsection
