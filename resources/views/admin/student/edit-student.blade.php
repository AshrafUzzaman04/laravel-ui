@extends("layouts.app")
@section("content")
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Student') }}</div>
                <div class="card-body">
                    <button class="btn btn-sm btn-secondary float-end" style="width: max-content"><a href="{{route("students.index")}}" class="text-white text-decoration-none font-bold">All Student</a></button>
                </div>
                <div class="card-body">
                    {{-- add class button --}}
                    @if (session()->has("success"))
                    <div class="alert alert-success">{{session()->get("success")}}</div>
                    @endif
                    <form method="POST" action="{{ route('students.update', Crypt::encryptString($students->id)) }}">
                        @csrf
                        @method("PUT")
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Student Name') }}</label>

                            <div class="col-md-6">
                                <input  type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{  old('name') ?? $students->name  }}">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Student Email') }}</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ??  $students->email }}">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label  class="col-md-4 col-form-label text-md-end">{{ __('Student Mobile') }}</label>

                            <div class="col-md-6">
                                <input type="number" class="form-control @error('number') is-invalid @enderror" name="number" value="{{   old('number') ?? $students->mobile  }}">

                                @error('number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label  class="col-md-4 col-form-label text-md-end">{{ __('Student Roll') }}</label>

                            <div class="col-md-6">
                                <input  type="number" class="form-control @error('roll') is-invalid @enderror" name="roll" value="{{   old('roll') ?? $students->roll  }}">

                                @error('roll')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label  class="col-md-4 col-form-label text-md-end">{{ __('Student Class') }}</label>

                            <div class="col-md-6">
                                <select name="class_id" class="form-control @error("class_id") is-invalid @enderror">
                                    @foreach ($classes as $class)
                                    <option value="{{$class->id}}" @if ( $students->class_id == $class->id )
                                        selected
                                    @endif>{{$class->name}}</option>
                                    @endforeach
                                </select>

                                @error('class_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update Student') }}
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
