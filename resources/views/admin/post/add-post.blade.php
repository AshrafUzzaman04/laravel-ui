@extends("layouts.backend.app")
@section("content")
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Add Post</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{route("post.store")}}" method="post">
                    @csrf
                    @method("post")
                  <div class="card-body">
                    <div class="form-group">
                      <label>Category</label>
                      <select  class="form-control @error("selectCatForPost")
                          is-invalid
                      @enderror" name="selectCatForPost">
                          @foreach ($categories as $row)
                          <option value="{{$row->id}}">{{$row->category_name}}</option>
                            @endforeach
                        </select>
                        @error("selectCatForPost")
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Sub Category</label>
                        <select  class="form-control @error("selectSubCatForPost")
                        is-invalid
                    @enderror" name="selectSubCatForPost">
                            @foreach ($subCategoires as $row)
                            <option value="{{$row->id}}">{{$row->sub_catname}}</option>
                              @endforeach
                        </select>
                        @error("selectSubCatForPost")
                      <div class="text-danger">{{$message}}</div>
                    @enderror
                      </div>

                    <div class="form-group">
                      <label>Post Title</label>
                      <input type="text" class="form-control @error("title")
                      is-invalid
                      @enderror" name="title" placeholder="Title" value="{{old("title")}}">
                        @error("title")
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                      <label>Description</label>
                      <textarea name="description" placeholder="Details" class="form-control @error("description")
                      is-invalid
                      @enderror">{{old("description")}}</textarea>
                        @error("description")
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                      <label for="postImgForCreate">File input</label>
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" name="postImg" id="postImgForCreate">
                          <label class="custom-file-label" for="postImgForCreate">Choose file</label>
                        </div>
                        <div class="input-group-append">
                          <span class="input-group-text">Upload</span>
                        </div>
                      </div>
                        @error("postImg")
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>

                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit Post</button>
                  </div>
                </form>
              </div>
        </div>
    </div>
</div>
@endsection
@push("script")
{!! Toastr::message() !!}
@endpush
