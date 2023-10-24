@extends("layouts.app")
@section("content")
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('All Class') }}</div>

                <div class="card-body">
                    {{-- add class button --}}
                    <button class="btn btn-sm btn-primary my-3 float-end"><a href="{{route("class.add")}}" class="text-white text-decoration-none font-bold">Add New Class</a></button>
                    <table class="table table-bordered table-responsive table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Serial No.</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($class as $cls)
                            <tr>
                                <td>{{$class->firstItem() + $loop->index}}</td>
                                <td>{{$cls->class_name}}</td>
                                <td>
                                    <div>
                                        <a href="{{route("class.edit", Crypt::encryptString($cls->id))}}" class="btn btn-sm btn-warning d-inline">Edit</a>
                                        <form action="{{route("class.destroy",Crypt::encryptString($cls->id))}}" class="d-inline" method="post">
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
                {{ $class->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
