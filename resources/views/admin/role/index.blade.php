@extends('layouts.admin')
@section('title', 'Noble Mahallu | Role Management')
@section('css_scripts')
<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
@stop
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Role Management</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Role Management</li>
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
          <!-- /.card -->

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Role Management</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="col-sm-12">
                @if(session()->get('success'))
                <div class="alert alert-success">
                  {{ session()->get('success') }}
                </div>
                @endif
              </div>
              <div>
                @can('role-create')
                <a style="margin: 19px;" href="{{ route('role.create')}}" class="btn btn-primary">New Role </a>
                @endcan
              </div>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th width="280px">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($roles as $key => $role)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{ $role->name }}</td>
                    <td>
                      @can('role-edit')
                      <a class="btn btn-primary" href="{{ route('role.edit',$role->id) }}" title="Edit {{ $role->name }} role"><i class="fas fa-edit"></i></a>
                      @endcan
                      @can('role-delete')
                      {!! Form::open(['method' => 'DELETE','route' => ['role.destroy', $role->id],'onsubmit' => 'return ConfirmDelete()','style'=>'display:inline','title'=>'Delete '.$role->name.' role']) !!}
                      {{ Form::button('<i class="fas fa-trash-alt"></i>', ['class' => 'btn btn-danger', 'type' => 'submit']) }}
                      {!! Form::close() !!}
                      @endcan
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
<!-- /.content-wrapper -->
@endsection
@section('scripts')
<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js') }}"></script>
<!-- page script -->
<script>
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
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
  function ConfirmDelete()
    {
    var x = confirm("Are you sure you want to delete?");
    if (x)
      return true;
    else
      return false;
    }
</script>
@stop