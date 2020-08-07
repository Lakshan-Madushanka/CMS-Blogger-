@extends('layouts.app');

@section('content')

    <div class="container">

        <div class="card card-default">
            <div class="card-header">
                {{isset($tag)? "Edit Tag" : "Create Tag"}}
            </div>

            <div class="card-body">
                <form action="{{isset($tag) ? route('tags.update', $tag->id) : route('tags.store')}}"
                      method="POST">
                    @csrf
                    @if(isset($tag))
                        @method('PATCH')
                    @endif
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control"
                               value="{{isset($tag) ? $tag->name : ''}}">
                        @error('name')
                        <div class="text-center text-danger mt-2">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success" type="submit" class="form-control">
                            {{isset($tag)? "Edit Tag" : "Create Tag"}}
                        </button>
                    </div>
                </form>
            </div>

        </div>

    </div>


@endsection
