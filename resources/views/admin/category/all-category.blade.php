@extends("layouts.app")
@section("content")
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('All Category') }}</div>
                @if (session()->has("status"))
                <div class="alert alert-success">{{session()->get("status")}}</div>
                @endif
                <div class="card-body overflow-x-scroll">
                    {{-- add class button --}}
                    <button class="btn btn-sm btn-primary my-3 float-end"><a href="{{route("category.create")}}" class="text-white text-decoration-none font-bold">Add New Category</a></button>
                    <table class="table table-bordered table-responsive table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Serial No.</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $sn => $row)
                            <tr>
                                <td>{{++$sn}}</td>
                                <td>{{$row->category_name}}</td>
                                <td>{{$row->category_slug}}</td>
                                <td>
                                    <div>
                                        <a href="{{route("category.edit", Crypt::encryptString($row->id))}}" class="btn btn-sm btn-warning d-inline">Edit</a>
                                        <form action="{{route("category.destroy",Crypt::encryptString($row->id))}}" class="d-inline" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
