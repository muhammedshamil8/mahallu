@extends('layouts.admin')
@section('title', 'Noble Mahallu | Add Member')
@section('css_scripts')
<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
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
          <h1>Member</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('committe.index') }}">Home</a></li>
            <li class="breadcrumb-item active">Member</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Add Member</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
            </div>
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
            <form method="post" action="{{ route('committee-members.store') }}" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="committee_id" value="{{$committee_id}}">
              <div class="row">
                <div class="col-sm-12">
                 <input type="radio" id="member" name="member_type" value="member" @if( old('member_type') == 'member' ) checked @endif>
                 <label for="member" >Member</label>
                 <input type="radio" id="non_member" name="member_type" value="non_member" @if( old('member_type') == 'non_member' ) checked @endif>
                 <label for="non_member" >Non Mahallu Member</label>
               </div>
             </div>
             <div class="row">
              <div class="col-sm-4" style="display: block;" id="member_div">
                <div class="form-group">
                  <label>Member<i class="fa fa-asterisk" style="color:red"></i></label>
                  <select class="form-control" name="member_id">
                    <option value="" disabled selected>Please select</option>
                    @foreach($members as $member)
                    @if (old('member_id') == $member->id)
                    <option value="{{ $member->id }}" selected>{{ $member->name }}</option>
                    @else
                    <option value="{{ $member->id }}">{{ $member->name }}</option>
                    @endif
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-sm-4" style="display: block;" id="non_member_div">
                <div class="form-group">
                  <label>Non Mahallu Member<i class="fa fa-asterisk" style="color:red"></i></label>
                  <select class="form-control" name="non_member_id">
                    <option value="" disabled selected>Please select</option>
                    @foreach($exe_members as $member)
                    @if (old('non_member') == $member->id)
                    <option value="{{ $member->id }}" selected>{{ $member->name }}</option>
                    @else
                    <option value="{{ $member->id }}">{{ $member->name }}</option>
                    @endif
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label>Desgination<i class="fa fa-asterisk" style="color:red"></i></label>
                  <select class="form-control" name="designation">
                    <option value="" disabled selected>Please select</option>
                    @foreach($designations as $designation)
                    @if (old('designation') == $designation->id)
                    <option value="{{ $designation->id }}" selected>{{ $designation->name }}</option>
                    @else
                    <option value="{{ $designation->id }}">{{ $designation->name }}</option>
                    @endif
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <input type="hidden" id="member_type_selected" value="{{ old('member_type') }}">
            <div class="col-sm-2">
              <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </div>
          </form>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

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
  <!-- Select2 -->
  <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
  <!-- bs-custom-file-input -->
  <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset('dist/js/demo.js') }}"></script>
  <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
  <script type="text/javascript">
    $(document).ready(function () {
      var member_type = $('#member_type_selected').val();
      if(member_type == 'member'){
        $("#member_div").show();
        $("#non_member_div").hide();
      }else {
        $("#member_div").hide();
        $("#non_member_div").show();
      }

      $("#member").click(function(){
        $("#member_div").show();
        $("#non_member_div").hide();
      });
      $("#non_member").click(function(){
        $("#non_member_div").show();
        $("#member_div").hide();
      });
    });


  </script>
  @stop