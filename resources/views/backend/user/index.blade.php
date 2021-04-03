@extends('layouts.app')

@section('title')
    Admin | Users | Manage
@endsection

@section('css')
    <style>
        ul.pagination {margin-bottom:0;}
        .toast {border: 1px solid #007BFF;}
        .infoMessage {z-index:999;}
        .top-right {top: 8px;right: 8px;}
    </style>
@endsection

@section('js')
    <script>
        function destroy(id) {
            $(".idUser").text(id);
            $(".destroy").attr("action", "{{ url('users') }}/"+id);
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
                    Are you sure want to delete this data with ID #<i class="idUser"></i> ?
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
                            <div class="col-6 h4 font-weight-bold">User - Manage</div>
                            <div class="col-6 text-right">
                                <a href="{{ route('users.create') }}" class="btn btn-sm btn-success">
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
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Created</th>
                                    <th class="text-center" width="250">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($users) > 0)
                                    @foreach ($users as $no => $item)
                                        <tr>
                                            <td class="text-center">{{ $users->firstItem() + $no }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('users.show', $item->id) }}" class="btn btn-sm btn-primary">
                                                    <i class="fas fa-search"></i> Show
                                                </a>
                                                <a href="{{ route('users.edit', $item->id) }}" class="btn btn-sm btn-success">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <button 
                                                @if (App\Models\Post::Where('user_id', $item->id)->count() == 0) onclick="destroy({{ $item->id }})" @endif 
                                                    class="btn btn-sm btn-danger @if(App\Models\Post::where('user_id', $item->id)->count() > 0 ) disabled @endif">
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
                    
                    @if (count($users) > 15)
                        <div class="card-footer">
                            {{ $users->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection