@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="{{route("class.index")}}" class="btn btn-sm btn-warning">Class</a>
                    <a href="{{route("students.index")}}" class="btn btn-sm btn-secondary">Students</a>

                    {{ __('You are logged in!') }} {{Auth::user()->name}}
                    <a href="{{route("view.user", Crypt::encryptString(Auth::user()->id))}}" class="btn btn-primary">Ashraf</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
