@extends("layouts.backend.app")
@section("content")
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Sub Category') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('sub-categories.update', Crypt::encryptString($get_subCat->id)) }}">
                        @csrf
                        @method("PUT")
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Sub Category Name') }}</label>

                            <div class="col-md-6">
                                <input  type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{  old('name') ?? $get_subCat->sub_catname  }}">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">Select Category</label>

                            <div class="col-md-6">
                                <select name="selectedCatForSubCat" class="form-control">
                                    @foreach ($categories as $row)
                                        <option value="{{$row->id}}" @if(($get_subCat->cat_id) == $row->id)
                                        selected
                                        @endif>{{$row->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update Sub Category') }}
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
