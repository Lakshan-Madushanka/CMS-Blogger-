@extends('layouts.app')

@section('content')

    <div class="container px-lg-5">
        {{--<div class="d-flex justify-content-end mb-2">
            <a href="{{route('tags.create')}}" class="btn btn-success">Tag</a>
        </div>--}}

{{--        <div class="container">--}}
            <div class="card card-default">
                <div class="card-header text-center">
                    <div class="text-center text-info">
                        <span class="font-weight-bolder">USERS</span>
                    </div>
                </div>

                <div class="card-body">

                    @if($users->count() > 0)
                        <table class="table table-bordered table-hover text-center">
                            <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>

                                <th class="text-center">Make Admin</th>
                              {{--  <th class="text-center">Edit</th>
                                <th class="text-center">Delete</th>--}}


                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>
                                        <img src="{{Gravatar::src($user->email)}}" width="30" height="30" alt="user">
                                    </td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    {{--<td>{{$user->role}}</td>--}}
                                    <td>{{$user->role}}</td>



                                    {{--<td class="text-center">{{$user->post->count()}}</td>--}}
                                    @if(!$user->isAdmin())
                                        <td class="text-center">
                                            <form action="{{route('make-admin', $user->id)}}" method="POST">
                                                @csrf
                                                 <button type="submit" class="btn btn-sm btn-outline-info">make admin</button>
                                            </form>
                                        </td>

                                        @else
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-outline-info" disabled>Admin</button>
                                            </td>
                                    @endif

                                    {{--<td class="text-center">
                                        <a href="{{route('tags.edit', $user->id)}}"
                                           class="btn btn-success btn-sm">edit</a>
                                    </td>--}}

                                    {{--<td class="text-center">
                                        <button class="btn btn-danger btn-sm" onclick="handleDelete({{$user->id}})">
                                            delete
                                        </button>
                                    </td>--}}

                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-center mb-0">
                            <a href = "{{route('posts.create')}}" class="btn btn-sm btn-info font-italic">Create New User</a>
                        </div>
                    @else
                        <h1 class="text-center">No Users has created yet</h1>
                @endif

                <!-- Modal -->
                    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                         aria-labelledby="deleteModalLabel" aria-hidden="true">
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
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Go
                                            Back
                                        </button>
                                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- End Model -->


                </div>
            </div>
{{--        </div>--}}

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
