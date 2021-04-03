@extends('layouts.app')

@section('title')
    Admin | Posts | Manage
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css">
    <style>
        ul.pagination {margin-bottom:0;}
        .toast {border: 1px solid #007BFF;}
        .infoMessage {z-index:999;}
        .top-right {top: 8px;right: 8px;}
    </style>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <script>
        function destroy(id) {
            $(".idPost").text(id);
            $(".destroy").attr("action", "{{ url('posts') }}/"+id);
            $(".modal").modal({
                show:true,
                backdrop:"static",
                keyboard:false
            });
        }
        $(function(){
            $(".toast").toast({autohide:true});     
            $(".toast").toast("show");
        });
    </script>
@endsection

@section('content')
    <div class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmation</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    Are you sure want to delete this data with ID #<i class="idPost"></i> ?
                </div>
                <div class="modal-footer">
                    <form action="" method="post" class="destroy">
                        @csrf
                        @method("DELETE")
                        <button  class="btn btn-sm btn-success">
                            <i class="fas fa-check"></i> Yes, Delete Now
                        </button>
                    </form>
                    <button data-dismiss="modal" class="btn btn-sm btn-danger">
                        <i class="fas fa-times"></i> Cancel
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
                            <div class="col-6 h4 font-weight-bold">Post - Manage</div>
                            <div class="col-6 text-right">
                                <a href="{{ route('posts.create') }}" class="btn btn-sm btn-success">
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
                                    <th>User</th>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th class="text-center" width="250">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($posts) > 0)
                                    @foreach ($posts as $no => $item)
                                        <tr>
                                            <td class="text-center">{{ $posts->firstItem() + $no }}</td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>
                                                <span class="badge badge-warning badge-pill border">{{ $item->category->title }}</span>
                                                <strong class="d-block">{{ $item->title }}</strong>
                                            </td>
                                            <td>
                                                <a href="{{ asset('img/post/'.$item->image) }}" data-fancybox>
                                                    <img src="{{ asset('img/post/'.$item->image) }}" alt="{{ $item->title }}" width="120" class="img-thumbnail">    
                                                </a>    
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('posts.show', $item->id) }}" class="btn btn-sm btn-primary">
                                                    <i class="fas fa-search"></i> Show
                                                </a>
                                                <a href="{{ route('posts.edit', $item->id) }}" class="btn btn-sm btn-success">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <button onclick="destroy({{ $item->id }})" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i> Destroy
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" class="text-danger">The data is empty!</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                            <div class="pagination">
                        {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection