@extends('layouts.app')

@section('content')

    <div class="container px-lg-5">
        {{--<div class="d-flex justify-content-end mb-2">
            <a href = "{{route('tags.create')}}" class="btn btn-success">Tag</a>
        </div>--}}

        <div class="container">
            <div class="card card-default">
                <div class="card-header">
                    <div class="text-center text-info">
                        <span class="font-weight-bolder">TAGS</span>
                    </div>
                </div>

                <div class="card-body">

                    @if($tags->count() > 0)
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th class="text-center">Edit</th>
                                <th class="text-center">Delete</th>


                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tags as $tag)
                                <tr>
                                    <td>{{$tag->name}}</td>

{{--                                    <td class="text-center">{{$tag->post->count()}}</td>--}}

                                    <td class="text-center">
                                        <a href="{{route('tags.edit', $tag->id)}}" class="btn btn-success btn-sm">edit</a>
                                    </td>

                                    <td class="text-center">
                                        <button class="btn btn-danger btn-sm" onclick="handleDelete({{$tag->id}})">delete</button>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-center mb-0">
                            <a href = "{{route('posts.create')}}" class="btn btn-sm btn-primary font-italic">Create New Tag</a>
                        </div>

                    @else
                        <h1 class="text-center">No Tags has created yet</h1>
                @endif

                <!-- Modal -->
                    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form action="" method="POST" id="deleteTagForm">
                                @csrf
                                @method('DELETE')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel">Delete Tag</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        This Will permenetly delete selected item !!
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Go Back</button>
                                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- End Model -->


                </div>
            </div>
        </div>

    </div>
@endsection

@section('script')
    <script>

        function handleDelete(catId) {

            $('#deleteTagForm').attr('action', '/cms/tags/' + catId);
            /*let form = document.getElementById('deleteTagForm');
            form.action = '/categories/' + catId;*/

            //console.log(form);
            $('#deleteModal').modal('show');
        }

    </script>

@endsection
