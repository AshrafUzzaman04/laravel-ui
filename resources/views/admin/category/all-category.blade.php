@extends("layouts.backend.app")
@push("css")
<link rel="stylesheet" href="{{asset("admin/backend")}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset("admin/backend")}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset("admin/backend")}}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endpush
@section("content")
<!-- Content Wrapper. Contains page content -->
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
              <div class="card-header">
                <h3 class="card-title">DataTable with minimal features & hover style</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
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
@endsection
@push("script")
<!-- DataTables  & Plugins -->
<script src="{{asset("admin/backend")}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset("admin/backend")}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{asset("admin/backend")}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{asset("admin/backend")}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{asset("admin/backend")}}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{asset("admin/backend")}}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{asset("admin/backend")}}/plugins/jszip/jszip.min.js"></script>
<script src="{{asset("admin/backend")}}/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{asset("admin/backend")}}/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{asset("admin/backend")}}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{asset("admin/backend")}}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{asset("admin/backend")}}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset("admin/backend")}}/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset("admin/backend")}}/dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
@endpush

