@extends('layouts.app')

@section('title')
    Admin | Category | Show #{{ $categories->id }}
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-6 h4 font-weight-bold">Category - Show #{{ $categories->id }}</div>
                                <div class="col-6 text-right">
                                    <a href="{{ route('admin.category.index') }}" class="btn btn-sm btn-danger">
                                        <i class="fas fa-backspace"></i> Back
                                    </a>
                                </div>
                            </div>
                        </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover table-striped mb-0">
                            <tbody>
                                <tr>
                                    <th>#ID</th>
                                    <td>{{ $categories->id }}</td>
                                </tr>
                                <tr>
                                    <th>#TITLE</th>
                                    <td>{{ $categories->title }}</td>
                                </tr>
                                <tr>
                                    <th>#SLUG</th>
                                    <td>{{ $categories->slug }}</td>
                                </tr>
                                <tr>
                                    <th>#CREATED</th>
                                    <td>{{ $categories->created_at }} ({{ $categories->created_at->diffForHumans() }})</td>
                                </tr>
                                <tr>
                                    <th>#UPDATED</th>
                                    <td>{{ $categories->updated_at }} ({{ $categories->updated_at->diffForHumans() }})</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection