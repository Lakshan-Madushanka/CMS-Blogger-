@extends('layouts.app')

@section('content')

    <div class="container px-lg-5 ">
        {{--<div class="d-flex justify-content-end mb-2">
            <a href = "{{route('posts.create')}}" class="btn btn-success">Post</a>
        </div>--}}

        <div class="card card-default">
            <div class="card-header">
                <div class="text-center text-info">
                    <span class="font-weight-bolder">POSTS</span>
                </div>
            </div>

            <div class="card-body">
                @if($posts->count() >0)
                    <table class="table table-bordered table-hover">

                        <thead>
                            <th>Image</th>
                            <th class="text-center">Title</th>
                            <th>Category</th>

                            @if(!$isTrash)
                            <th>Edit</th>
                            @else
                            <th>Restore</th>
                            @endif
                            <th>{{$isTrash ? 'Delete' : 'Trash'}}</th>

                        </thead>

                        <tbody>
                            @foreach($posts as $post)
                            <tr>

                                <td>
                                    <img src="{{asset('/storage/'. $post->image)}}" width="75px" height="35px" alt="post image">
                                </td>
                                <td>
                                    {{$post->title}}
                                </td>

                                <td>{{$post->category ? $post->category->name : ''}}</td>

                                @if(!$post->trashed())
                                    <td>
                                        <a href="{{route('posts.edit', $post->id)  }}" class="btn btn-warning btn-sm">edit</a>
                                    </td>
                                @else
                                    <td>
                                        <form action="{{route('restore-post', $post->id)}}" method="POST">
                                            @csrf
                                            @method("PUT")
                                            <button type="submit"class="btn btn-info btn-sm">Restore</button>
                                        </form>
                                    </td>
                                @endif

                                <td>
                                    <form action="{{route('posts.destroy', $post->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                         <button type="submit" class="btn btn-danger btn-sm">
                                             {{$post->trashed() ? 'delete' : 'trash'}}
                                         </button>
                                    </form>
                                </td>

                            </tr>
                             @endforeach
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-center mb-0">
                        <a href = "{{route('posts.create')}}" class="btn btn-sm btn-primary font-italic">Create New Post</a>
                    </div>

                    @else
                        <h1 class="text-center">No Posts Yet</h1>
                @endif
            </div>
        </div>
    </div>
@endsection
