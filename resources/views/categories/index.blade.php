@extends('layouts.app')

@section('content')

<div class="container px-lg-5">
    {{--<div class="d-flex justify-content-end mb-2">
    <a href = "{{route('categories.create')}}" class="btn btn-success">Category</a>
    </div>--}}

    <div class="container">
        <div class="card card-default">
            <div class="card-header">
                <div class="text-center text-info">
                    <span class="font-weight-bolder">CATEGORIES</span>
                </div>
            </div>

            <div class="card-body">

                    @if($categories->count() > 0)
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th class="text-center">Post Count</th>
                                    <th class="text-center">Edit</th>
                                    <th class="text-right">Delete</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                <tr>
                                    <td>{{$category->name}}</td>

                                    <td class="text-center">{{$category->post->count()}}</td>

                                    <td class="text-center">
                                        <a href="{{route('categories.edit', $category->id)}}" class="btn btn-success btn-sm">edit</a>
                                    </td>

                                    <td class="text-right">
                                        <button class="btn btn-danger btn-sm" onclick="handleDelete({{$category->id}})">delete</button>
                                    </td>

                                </tr>
                                 @endforeach
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-center mb-0">
                            <a href = "{{route('posts.create')}}" class="btn btn-sm btn-primary font-italic">Create New Category</a>
                        </div>

                    @else
                        <h1 class="text-center">No Categories has created yet</h1>
                    @endif

                    <!-- Modal -->
                    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form action="" method="POST" id="deleteCategoryForm">
                                @csrf
                                @method('DELETE')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel">Delete Category</h5>
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
        console.log('lakshan');
        $('#deleteCategoryForm').attr('action', '/cms/categories/' + catId);
        /*let form = document.getElementById('deleteCategoryForm');
        form.action = '/categories/' + catId;*/

        //console.log(form);
        $('#deleteModal').modal('show');
    }

 </script>

@endsection
