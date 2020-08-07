@extends('layouts.app');

@section('content')

    <div class="container">

        <div class="card card-default">
            <div class="card-header text-center">
                 Update User Profile
            </div>

            <div class="card-body">
                <form action="{{route('users.update-profile')}}" method="POST">
                    @csrf
                        @method('PUT')

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control"
                               value="{{isset($user) ? $user->name : ''}}">
                        @error('name')
                        <div class="text-center text-danger mt-2">{{$message}}</div>
                        @enderror
                    </div>

                    {{--<div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" id="name" name="name" class="form-control"
                               value="{{isset($user) ? $user->email : ''}}">
                        @error('name')
                        <div class="text-center text-danger mt-2">{{$message}}</div>
                        @enderror
                    </div>--}}

                    {{--<div class="form-group">
                        <label for="role">Role</label>
                        <input type="text" id="name" name="name" class="form-control"
                               value="{{isset($user) ? $user->role : ''}}">
                        @error('name')
                        <div class="text-center text-danger mt-2">{{$message}}</div>
                        @enderror
                    </div>--}}

                    <div class="form-group">
                        <label for="about">About</label>
                        <textarea type="text" id="about" name="about" class="form-control">
                               {{isset($user) ? $user->about : ''}}
                        </textarea>
                        @error('about')
                        <div class="text-center text-danger mt-2">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button class="btn btn-success" type="submit" class="form-control">
                            Update Profile
                        </button>
                    </div>
                </form>
            </div>

        </div>

    </div>


@endsection
