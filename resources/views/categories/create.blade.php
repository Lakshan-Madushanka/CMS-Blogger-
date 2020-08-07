@extends('layouts.app');

@section('content')

    <div class="container">

        <div class="card card-default">
            <div class="card-header">
                {{isset($category)? "Edit Categiry" : "Create Category"}}
            </div>

            <div class="card-body">
                    <form action="{{isset($category) ? route('categories.update', $category->id) : route('categories.store')}}"
                          method="POST">
                        @csrf
                        @if(isset($category))
                            @method('PATCH')
                         @endif
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control"
                                   value="{{isset($category) ? $category->name : ''}}">
                            @error('name')
                            <div class="text-center text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success" type="submit" class="form-control">
                                {{isset($category)? "Edit Categiry" : "Create Category"}}
                            </button>
                        </div>
                    </form>
                </div>

        </div>

    </div>


@endsection
