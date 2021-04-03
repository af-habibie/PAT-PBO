@extends('layouts.app')

@section('title')
    Admin | User | Edit ID #{{ $user->id }}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-6 h4 font-weight-bold">User - Edit ID #{{ $user->id }}</div>
                        <div class="col-6 text-right">
                                <a href="{{ route('users.index') }}" class="btn btn-sm btn-danger">
                                    <i class="fas fa-backspace"></i> Back
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('users.update', $user->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Name<span class="text-danger">*</span></label>
                                <input type="text" @if($user->is_admin == 1) readonly="readonly" @endif value="{{ $user->name }}" name="name" placeholder="Name" class="form-control @error('name') is-invalid @enderror">
                                @error('name') <code>{{ $message }}</code> @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email<span class="text-danger">*</span></label>
                                <input type="text" @if($user->is_admin == 1) readonly="readonly" @endif value="{{ $user->email }}" name="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror">
                                @error('email') <code>{{ $message }}</code> @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password<span class="text-danger">*</span></label>
                                <input type="password" value="{{ old('password') }}" name="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror">
                                @error('password') <code>{{ $message }}</code> @enderror
                            </div>
                            <button type="submit" class="btn btn-success"><i class="fas fa-edit"></i> Edit</button>
                            <input type="hidden" name="is_admin" value="0">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection