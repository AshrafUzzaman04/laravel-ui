@extends("layouts.app")
@section("content")
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Class') }}</div>
                <div class="card-body">
                    <button class="btn btn-sm btn-secondary float-end" style="width: max-content"><a href="{{ route("class.index") }}" class="text-white text-decoration-none font-bold">All Class</a></button>
                </div>
                <div class="card-body">
                    {{-- add class button --}}
                    @if (session()->has("success"))
                    <div class="alert alert-success">{{session()->get("success")}}</div>
                    @endif
                    <form method="POST" action="{{ route('class.update', Crypt::encryptString($class->id))}}">
                        @csrf
                        @method("put")
                        <div class="row mb-3">
                            <label  class="col-md-4 col-form-label text-md-end">{{ __('Class Name') }}</label>

                            <div class="col-md-6">
                                <input  type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $class->name ?? old('name') }}">

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
                                    {{ __('Update') }}
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
