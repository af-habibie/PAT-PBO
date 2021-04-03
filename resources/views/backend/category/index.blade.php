@extends('layouts.app')

@section('title')
    Admin | Category
@endsection

@section('css')
    <style> 
    ul.pagination {margin-bottom:0;}
    </style>
@endsection


@section('js')
    <script>
        function destroy(id) {
            $(".idCategory").text(id);
            $("input[name=id]").attr("value", id);
            $(".modal").modal({
                show:true
            });
        }
    </script>
@endsection

@section('content')

<div class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmation</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are You Sure You Want To Delete This Data With ID #<i class="idCategory"></i>?
                </div>
                <div class="modal-footer">
                    <form action="{{ route('admin.category.destroy') }}" method="post">
                        @csrf
                        @method("POST")
                        <input type="hidden" name="id" value="">
                        <button class="btn btn-sm btn-success">
                            <i class="fas fa-check bg-success"></i> Yes
                        </button>
                    </form>
                    <button data-dismiss="modal" class="btn btn-sm btn-danger">
                        <i class="fas fa-times bg-danger"></i> Cancel
                    </button>
                </div>
            </div>
        </div>
</div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-6 h4 font-weight-bold">Category - Manage</div>
                                <div class="col-6 text-right">
                                    <a href="{{ route('admin.category.create') }}" class="btn btn-sm btn-success">
                                        <i class="fas fa-plus-circle"></i> Create
                                    </a>
                                </div>
                            </div>
                        </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover table-striped mb-0">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Title</th>
                                    <th>Slug</th>
                                    <th class="text-center" width="250">Action</th>
                                </tr>
                            </thead>
                                <tbody>
                                    @if (count($categories) > 0)
                                        @foreach ($categories as $no => $item)
                                            <tr>
                                                <td class="text-center">{{ $categories->firstItem() +$no }}</td>
                                                <td>{{ $item->title }}</td>
                                                <td>{{ $item->slug }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('admin.category.show', $item->slug) }}" class="btn btn-sm btn-primary">
                                                        <i class="fas fa-search"></i> View
                                                    </a>
                                                    <a href="{{ route('admin.category.edit', $item->slug) }}" class="btn btn-sm btn-success">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                    <button onclick="destroy({{ $item->id }})" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i> Destroy
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <div class="pagination">
                        {{ $categories->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection