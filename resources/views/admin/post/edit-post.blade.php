@extends("layouts.backend.app")
@section("content")
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Post') }}</div>
                <div class="card-body">
                    <form action="{{route("post.update", Crypt::encryptString($post->id))}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method("put")
                      <div class="card-body">
                        <div class="form-group">
                          <label>Category</label>
                          <select  class="form-control @error("selectCatForPost")
                              is-invalid
                          @enderror" name="selectCatForPost">
                              @foreach ($categories as $row)
                              <option value="{{$row->id}}" @if ($post->cat_id === $row->id)
                                selected
                              @endif>{{$row->category_name}}</option>
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
                                @foreach ($subCategories as $row)
                                <option value="{{$row->id}}" @if ($post->subcat_id === $row->id)
                                    selected
                                  @endif>{{$row->sub_catname}}</option>
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
                          @enderror" name="title" placeholder="Title" value="{{old("title") ?? $post->title}}">
                            @error("title")
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                          <label>Description</label>
                          <textarea name="description" placeholder="Details" class="form-control @error("description")
                          is-invalid
                          @enderror">{{ old("description") ?? $post->description}}</textarea>
                            @error("description")
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                          <label for="postImgForCreate">File input</label>
                          <div class="input-group">
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" name="postImg" id="postImgForCreate" value="{{old("postImg")}}">
                              <input type="hidden" name="old_image" value="{{$post->post_image}}">
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

                        <div>
                            <input type="checkbox" id="statusForInsertPost" name="status" value="1" {{($post->status === 1) ? "checked" : null}}>
                            <label for="statusForInsertPost">&nbsp Publish Now!</label>
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
</div>
@endsection
@push("script")
{!! Toastr::message() !!}
@endpush
