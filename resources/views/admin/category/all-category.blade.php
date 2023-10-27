@extends("layouts.backend.app")
@push("css")
<link rel="stylesheet" href="{{asset("backend")}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset("backend")}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset("backend")}}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset("backend/plugins/sweetalert2/sweetalert2.min.css")}}">
@endpush
@section("content")
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>All Categories</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route("admin.view")}}">Home</a></li>
                <li class="breadcrumb-item active">All Categories</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
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
                                <form action="{{route("category.destroy",Crypt::encryptString($row->id))}}" class="d-inline cat-dlt-form" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="button" class="btn btn-sm btn-danger cat-delete">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
<!-- Content Wrapper. Contains page content -->
@endsection
@push("script")
<!-- DataTables  & Plugins -->
<script src="{{asset("backend")}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset("backend")}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{asset("backend")}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{asset("backend")}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{asset("backend")}}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{asset("backend")}}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{asset("backend")}}/plugins/jszip/jszip.min.js"></script>
<script src="{{asset("backend")}}/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{asset("backend")}}/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{asset("backend")}}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{asset("backend")}}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{asset("backend/plugins/sweetalert2/sweetalert2.min.js")}}"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    // $('#example2').DataTable({
    //   "paging": true,
    //   "lengthChange": false,
    //   "searching": false,
    //   "ordering": true,
    //   "info": true,
    //   "autoWidth": false,
    //   "responsive": true,
    // });
  });
</script>

<script>
    $(document).ready(function (){
        $(".cat-delete").click(function (){
            Swal.fire({
            title: 'Are you sure?',
            text: "You deleted this category!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).parent(".cat-dlt-form").submit();
                }
            })
        })
    })
</script>

{!! Toastr::message() !!}
@endpush

