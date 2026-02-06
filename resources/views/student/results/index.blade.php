@extends('layouts.student')
@section('title', 'Alpha Academy | Dashboard')
@section('css_scripts')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@stop
@section('content')
<!doctype html>
<!-- breadcrum -->
<section class="w3l-skill-breadcrum">
  <div class="breadcrum">
    <div class="container">
      <p><a href="{{route('student/dashboard')}}">Home</a> &nbsp; / &nbsp; Lessons</p>
    </div>
  </div>
</section>
<!-- //breadcrum -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <!-- /.card -->

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Result</h3>
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
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Result</th>
                    <th >Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($results as $result)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $result->created_at ?? '' }}</td>
                                <td>{{ $result->result }}/10</td>
                    <td>
                      <a href="{{ route('results.show',[Crypt::encryptString($result->id)]) }}" class="btn btn-primary">View</a>
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
@endsection

@section('scripts')
<!-- DataTables -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<!-- page script -->
<script>
  $(function () {
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
</script>
@stop