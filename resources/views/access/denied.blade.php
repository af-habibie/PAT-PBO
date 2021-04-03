@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">Error</div>
                    <div class="card-body text-danger">
                        @if (Session::has('error'))
                            {{ Session::get('error') }}
                        @else
                            Access Denied.
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection