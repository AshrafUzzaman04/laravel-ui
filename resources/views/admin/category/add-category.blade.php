@extends("layouts.backend.app")
@section("content")
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Category') }}</div>
                <div class="card-body">
                    {{-- add class button --}}
                    @if (session()->has("status"))
                    <div class="alert alert-success">{{session()->get("status")}}</div>
                    @endif
                    <form method="POST" action="{{ route('category.store') }}">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Category Name') }}</label>

                            <div class="col-md-6">
                                <input  type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add Category') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push("script")
{!! Toastr::message() !!}
@endpush
