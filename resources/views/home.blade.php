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
                    {{ __('Welcome!') }} {{Auth::user()->name}}
                    <a href="{{route("admin.view")}}"  class="btn btn-sm btn-primary d-block w-25 my-3">Admin Panel</a>
                    {{-- <a href="{{route("view.user", Crypt::encryptString(Auth::user()->id))}}" class="btn btn-primary">Ashraf</a> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
