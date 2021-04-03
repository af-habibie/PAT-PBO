@extends('layouts.app')

@section('title')
    Admin | User | Create
@endsection

@section('js')    
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    </script>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-6 h4 font-weight-bold">User - Create</div>
                                <div class="col-6 text-right">
                                    <a href="{{ route('users.index') }}" class="btn btn-sm btn-danger">
                                        <i class="fas fa-backspace"></i> Back
                                    </a>
                                </div>
                            </div>
                        </div>
                    <div class="card-body">
                        <form action="{{ route('users.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name<span class="text-danger">*</span></label>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="Name" class="form-control @error('name') is-invalid @enderror">
                            @error('name') <code>{{ $message }}</code> @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email<span class="text-danger">*</span></label>
                            <input type="text" name="email" value="{{ old('email') }}" placeholder="Email" class="form-control @error('email') is-invalid @enderror">
                            @error('email') <code>{{ $message }}</code> @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password<span class="text-danger">*</span></label>
                            <input type="password" name="password" value="{{ old('password') }}" placeholder="password" class="form-control @error('password') is-invalid @enderror">
                            @error('password') <code>{{ $message }}</code> @enderror
                        </div>
                        <button type="submit" class="btn btn-success"><i class="fas fa-plus-circle"></i> Create</button>
                        <input type="hidden" name="is_admin" value="0">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection