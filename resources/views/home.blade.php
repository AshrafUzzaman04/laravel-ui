@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('msg.Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('msg.Welcome') }}! {{Auth::user()->name}}
                    <div class="d-block">
                        @if (Auth::user()->is_admin === 1)
                        <a href="{{route("admin.view")}}"  class="btn btn-sm btn-success mx-1 my-3">{{__("msg.AdminPanel")}}</a>
                        @endif
                        <a href="{{route("class.index")}}"  class="btn btn-sm btn-danger mx-1 my-3">{{__("msg.Classes")}}</a>
                        <a href="{{route("students.index")}}"  class="btn btn-sm btn-success mx-1 my-3">{{__("msg.Students")}}</a>
                    </div>
                    {{-- <a href="{{route("view.user", Crypt::encryptString(Auth::user()->id))}}" class="btn btn-primary">Ashraf</a> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
