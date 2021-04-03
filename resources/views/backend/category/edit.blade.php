@extends('layouts.app')

@section('title')
    Admin | Category | Edit #{{ $categories->id }}
@endsection

@section('js')
    <script>
        $(function(){
            $("input[name=title]").keyup(function(){
                var str = $(this).val();
                str = str.toLowerCase();
                str = str.replace(/[^a-zA-Z0-9]+/g,'-');
                $("input[name=slug]").val(str);        
            });
        });
    </script>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-6 h4 font-weight-bold">Category - Edit</div>
                                <div class="col-6 text-right">
                                    <a href="{{ route('admin.category.index') }}" class="btn btn-sm btn-danger">
                                        <i class="fas fa-backspace"></i> Back
                                    </a>
                                </div>
                            </div>
                        </div>
                    <div class="card-body">
                        <form action="{{ route('admin.category.update') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title<span class="text-danger">*</span></label>
                            <input type="text" name="title" value="{{ $categories->title }}" placeholder="title" class="form-control @error('title') is-invalid @enderror">
                            @error('title') <code>{{ $message }}</code> @enderror
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug<span class="text-danger">*</span></label>
                            <input type="text" name="slug" value="{{ $categories->slug }}" placeholder="slug" class="form-control @error('slug') is-invalid @enderror">
                            @error('slug') <code>{{ $message }}</code> @enderror
                        </div>
                        <button type="submit" class="btn btn-success"><i class="fas fa-edit"></i> Edit</button>
                        <input type="hidden" name="id" value="{{ $categories->id }}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection