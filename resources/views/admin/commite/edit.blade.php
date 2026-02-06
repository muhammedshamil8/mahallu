@extends('layouts.admin')
@section('title', 'Noble Mahallu | Edit Committe')
@section('css_scripts')
<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
<!-- summernote -->
<link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css') }}">
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
          <h1>{{$committe->name}}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('committe.index') }}">Home</a></li>
            <li class="breadcrumb-item active">Committe</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row">
      <div class="container-fluid">
        <div class="col-12 col-sm-12">
          <div class="card card-primary card-outline card-tabs">
            <div class="card-header p-0 pt-1 border-bottom-0">
              <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Committe</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Members</a>
                </li>
              </ul>
            </div>
            <div class="card-body">
              @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div><br />
              @endif
              @if(session()->get('success'))
              <div class="alert alert-success">
                {{ session()->get('success') }}  
              </div>
              @endif
              <div class="tab-content" id="custom-tabs-three-tabContent">
                <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">

                  <form method="post" action="{{route('committe.update',$committe->id)}}">
                    @method('PATCH')
                    @csrf
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label>Name<i class="fa fa-asterisk" style="color:red"></i></label>
                          <input type="text" class="form-control" placeholder="Committe name" name="name" value="{{$committe->name}}">
                        </div>
                      </div>
                      <div class="col-sm-8">
                        <div class="form-group">
                          <label>Description</label>
                          <input type="text" class="form-control" placeholder="If you have any notes..." name="description" value="{{$committe->description}}">
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </div>
                  </form> 
                </div>
                <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                  <a style="margin: 19px;" href="{{ route('committee-members.create',['id' => $committe->id])}}" class="btn btn-primary"><i class="fa fa-plus"></i>Add Members</a>


                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Member Name</th>
                        <th>Designation</th>
                        <th>Phone</th>
                        <th>Whatsapp</th>
                        <th >Action</th><th></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($members as $member)
                      <tr>
                        <td>{{$loop->iteration}}</td>
                        @if($member->member_type =='member')   
                        <td>{{$member->member->name}}</td>
                        <td>{{$member->designation->name}}</td><td><a href="tel:{{$member->member->mobile}}">{{$member->member->mobile}}</a></td>
                        <td>
                          <a href="https://wa.me/+91{{$member->member->whatsapp}}">{{$member->member->whatsapp}}</a></td>
                          @else
                          <td>{{$member->executiveMember->name}}</td>
                          <td>{{$member->designation->name}}</td>
                          <td><a href="tel:{{$member->executiveMember->mobile_number}}">{{$member->executiveMember->mobile_number}}</a></td>
                          <td><a href="https://wa.me/{{$member->executiveMember->whatsapp_number}}">{{$member->executiveMember->whatsapp_number}}</a></td>
                          @endif
                          <td>
                            <a href="{{ route('committee-members.edit',$member->id)}}" class="btn btn-primary">Edit</a>
                          </td>
                          <td>
                            <form action="{{ route('committee-members.destroy', $member->id)}}" method="post">
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>
        </div>
      </div>
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
  <!-- Select2 -->
  <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
  <!-- bs-custom-file-input -->
  <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset('dist/js/demo.js') }}"></script>
  <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
  <script>
    $(function () {
    // Summernote
    $('.textarea').summernote()
  })
</script>
<script type="text/javascript">
  $(document).ready(function () {
    $('#custom-tabs-three-tab a[href="#{{ old('tab') }}"]').tab('show')
  });
</script>
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