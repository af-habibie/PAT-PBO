@extends('layouts.app')

@section('title')
    My Profile | Edit
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-6 h4 font-weight-bold">Profile - Edit #{{ $user->id }}</div>
                                <div class="col-6 text-right">
                                    <a href="{{ route('contributor.post.manage') }}" class="btn btn-sm btn-danger">
                                        <i class="fas fa-backspace"></i> Back
                                    </a>
                                </div>
                            </div>
                        </div>
                    <div class="card-body">
                        <form action="{{ route('contributor.update') }}" method="post">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <div class="form-group">
                            <label for="name">Name<span class="text-danger">*</span></label>
                            <input type="text" @if($user->is_admin == 1) readonly="readonly" @endif name="name" value="{{ $user->name }}" placeholder="Name" class="form-control @error('name') is-invalid @enderror">
                            @error('name') <code>{{ $message }}</code> @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email<span class="text-danger">*</span></label>
                            <input type="text"  @if($user->is_admin == 1) readonly="readonly" @endif name="email" value="{{ $user->email}}" placeholder="Email" class="form-control @error('email') is-invalid @enderror">
                            @error('email') <code>{{ $message }}</code> @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password<span class="text-danger">*</span></label>
                            <input type="password" name="password" value="{{ old('password') }}" placeholder="password" class="form-control @error('password') is-invalid @enderror">
                            @error('password') <code>{{ $message }}</code> @enderror
                        </div>
                        <button type="submit" class="btn btn-success"><i class="fas fa-pencil"></i> Edit</button>
                        <input type="hidden" name="is_admin" value="0">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection