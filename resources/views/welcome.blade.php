@extends('layouts.blog')

@section('title')
    My Blog
@endsection

<!-- Header -->
@section('header')

    <header class="header text-center text-white"
            style="background-image: linear-gradient(-225deg, #5D9FFF 0%, #B8DCFF 48%, #6BBBFF 100%);">
        <div class="container">

            <div class="row">
                <div class="col-md-8 mx-auto">

                    <h1>Latest Blog Posts</h1>
                    <p class="lead-2 opacity-90 mt-6">Read and get updated on how we progress</p>

                </div>
            </div>

        </div>
    </header><!-- /.header -->

@endsection

@section('css')
    <style>
        .col-height-fixed {
            overflow: hidden;
            height: 420px;
        }

        .img-height-fixed {
            height: 220px;
            object-fit: cover;
        }

    </style>
@endsection
<!-- Main Content -->
@section('content')

    <main class="main-content">
        <div class="section bg-gray">
            <div class="container">
                <div class="row">


                    <div class="col-md-8 col-xl-9">
                        <div class="row gap-y">


                            {{--                            @if($posts->count() > 0)--}}
                            @forelse($posts as $post)

                                <div class="col-md-6 col-height-fixed">
                                    <div class="card border hover-shadow-6 mb-6 d-block">
                                        <a href="{{route('blog.show', $post->id)}}">
                                            <img class="card-img-top img-height-fixed"
                                                 src="{{asset('storage/'.$post->image)}}"
                                                 alt="Card image cap">
                                        </a>
                                        <div class="p-6 text-center">
                                            <p><a class="small-5 text-lighter text-uppercase ls-2 fw-400" href="#">
                                                    {{$post->category->name}}
                                                </a>
                                            </p>
                                            <h5 class="mb-0"><a class="text-dark" href="#">
                                                    {{$post->title}}
                                                </a></h5>
                                        </div>
                                    </div>
                                </div>

                            @empty
                                @if(request()->query('search'))
                                    <div class="col-md-6 mx-auto bg-gradient-warning">
                                        <h1 class="text-danger">No Results Found for : {{request()->query('search')}}</h1>
                                    </div>

                                @else
                                    <div class="col-md-6 mx-auto bg-gradient-warning">
                                        <h1 class="text-info">No posts has been published </h1>
                                    </div>
                                @endif
                            @endforelse
                            {{-- @else
                                 <h1 class="text-info text-center">No posts has been created yet</h1>
                             @endif--}}

                        </div>

                        {{-- <nav class="flexbox mt-30">
                             <a class="btn btn-white disabled"><i class="ti-arrow-left fs-9 mr-4"></i> Newer</a>
                             <a class="btn btn-white" href="#">Older <i class="ti-arrow-right fs-9 ml-4"></i></a>
                         </nav>--}}

                        {{$posts->appends(['search' => request()->query('search')])->links()}} {{-- paginatiions --}}

                    </div>

                @include('partials.sidebar')

                </div>
            </div>
        </div>
    </main>

@endsection

