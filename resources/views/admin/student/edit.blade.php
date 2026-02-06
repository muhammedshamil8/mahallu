@extends('layouts.admin')
@section('title', 'Noble Mahallu | Edit Student')
@section('css_scripts')
<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
<!-- summernote -->
<link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css') }}">
<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<style type="text/css">
    .required:after {
    content:" *";
    color: red;
  }
</style>
@stop
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Student</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('students.index') }}">Home</a></li>
            <li class="breadcrumb-item active">Student</li>
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
        <h3 class="card-title">Edit Student</h3>

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
            <form method="post" action="{{ route('students.update',$student->id) }}" >
              @method('PATCH') 
              @csrf
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="required">പേര്</label>
                    <input type="text" class="form-control" placeholder="Name" name="name" value="{{ $student->name }}">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="required">Mobile Number</label>
                    <input type="text" class="form-control" placeholder="Mobile Number" name="mobile_number" value="{{ $student->mobile_number }}">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="required">WhatsApp Number</label>
                    <input type="text" class="form-control" placeholder="WhatsApp number" name="whatsapp_number" value="{{ $student->whatsapp_number }}">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="required">Father Name</label>
                    <input type="text" class="form-control" placeholder="Name" name="father_name" value="{{ $student->father_name }}">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label >Father Mobile Number</label>
                    <input type="text" class="form-control" placeholder="Mobile Number" name="father_mobile_number" value="{{ $student->father_mobile_number }}">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label >Father WhatsApp Number</label>
                    <input type="text" class="form-control" placeholder="WhatsApp number" name="father_whatsapp_number" value="{{ $student->father_whatsapp_number }}">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="required">Mother Name</label>
                    <input type="text" class="form-control" placeholder="Name" name="mother_name" value="{{ $student->mother_name }}">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label >Mother Mobile Number</label>
                    <input type="text" class="form-control" placeholder="Mobile Number" name="mother_mobile_number" value="{{ $student->mother_mobile_number }}">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label >Mother WhatsApp Number</label>
                    <input type="text" class="form-control" placeholder="WhatsApp number" name="mother_whatsapp_number" value="{{ $student->mother_whatsapp_number }}">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-9">
                  <div class="form-group">
                    <label>ജനനതിയ്യതി  </label>
                    <div class="row">
                      <div class="col-sm-4">
                        <select id="day" name="day" class="form-control" onchange="setDays(month,this,year)">
                          {{ $last= 31 }}
                          {{ $now = 1 }}

                          @for ($i = $now; $i <= $last; $i++)
                          <option value="{{ $i }}" @if ($day == $i) selected="selected" @endif>{{ $i }}</option>
                          @endfor
                        </select>
                      </div>
                      <div class="col-sm-4">
                        <select id="month" name="month" class="form-control" onchange="setDays(this,day,year)">
                          {{ $last= 1 }}
                          {{ $now = 12 }}

                          @for ($i = 1; $i <= 12; $i++)
                          <option value="{{ $i }}" @if ($month == $i) selected="selected" @endif>{{ $i }}</option>
                          @endfor
                        </select>
                      </div>
                      <div class="col-sm-4">
                        <select id="year" name="year" class="form-control" onchange="setDays(month,day,this)">
                          {{ $last= date('Y')-120 }}
                          {{ $now = date('Y') }}

                          @for ($i = $last; $i <= $now; $i++)
                          <option value="{{ $i }}" @if ($year == $i) selected="selected" @endif>{{ $i }}</option>
                          @endfor
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label>Age </label>
                    <input type="text" class="form-control" id="age-txt" placeholder="Age" onBlur="calculateDOB(this.value)">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="required">Gender</label>
                    <select class="form-control" name="gender">
                      <option value="" selected>Please select</option>
                      <option value="male" @if ($student->gender == 'male') selected="selected" @endif>Male</option>
                      <option value="female" @if ($student->gender == 'female') selected="selected" @endif>Female</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label >Fee</label>
                    <input type="text" class="form-control" placeholder="Fee" name="fee" value="{{ $student->fee }}">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="required">Class</label>
                    <select class="form-control" name="class">
                      <option value="" selected>Please select</option>
                      @foreach($classes as $class)
                      @if ($student->class_id == $class->id)
                      <option value="{{ $class->id }}" selected>{{ $class->name }}</option>
                      @else
                      <option value="{{ $class->id }}">{{ $class->name }}</option>
                      @endif
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Address</label>
                    <textarea class="form-control" name="address" placeholder="Enter ...">{{ $student->address }}</textarea>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="description" placeholder="Enter ...">{{ $student->description }}</textarea>
                  </div>
                </div>
              </div>
              <div class="col-sm-2">
                <button type="submit" class="btn btn-primary btn-block">Update</button>
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
    bsCustomFileInput.init();
  });

</script>

@stop