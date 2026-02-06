@extends('layouts.admin')
@section('title', 'Noble Mahallu | Add Student')
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
            <li class="breadcrumb-item"><a href="{{ route('staffs.index') }}">Home</a></li>
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
        <h3 class="card-title">Add Student</h3>

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
            <form method="post" action="{{ route('students.store') }}" >
              @csrf
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="required">പേര്</label>
                    <input type="text" class="form-control" placeholder="Name" name="name" value="{{ old('name') }}">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="required">Mobile Number</label>
                    <input type="text" class="form-control" placeholder="Mobile Number" name="mobile_number" value="{{ old('mobile_number') }}">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="required">WhatsApp Number</label>
                    <input type="text" class="form-control" placeholder="WhatsApp number" name="whatsapp_number" value="{{ old('whatsapp_number') }}">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="required">Father Name</label>
                    <input type="text" class="form-control" placeholder="Name" name="father_name" value="{{ old('father_name') }}">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label >Father Mobile Number</label>
                    <input type="text" class="form-control" placeholder="Mobile Number" name="father_mobile_number" value="{{ old('father_mobile_number') }}">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label >Father WhatsApp Number</label>
                    <input type="text" class="form-control" placeholder="WhatsApp number" name="father_whatsapp_number" value="{{ old('father_whatsapp_number') }}">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="required">Mother Name</label>
                    <input type="text" class="form-control" placeholder="Name" name="mother_name" value="{{ old('father_name') }}">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label >Mother Mobile Number</label>
                    <input type="text" class="form-control" placeholder="Mobile Number" name="mother_mobile_number" value="{{ old('mother_mobile_number') }}">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label >Mother WhatsApp Number</label>
                    <input type="text" class="form-control" placeholder="WhatsApp number" name="mother_whatsapp_number" value="{{ old('mother_whatsapp_number') }}">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-9">
                  <div class="form-group">
                    <label class="required">ജനനതിയ്യതി  </label>
                    <div class="row">
                      <div class="col-sm-4">
                        <select id="day" name="day" class="form-control" onchange="setDays(month,this,year)">
                          {{ $last= 31 }}
                          {{ $now = 1 }}

                          @for ($i = $now; $i <= $last; $i++)
                          <option value="{{ $i }}" @if (old('day') == $i) selected="selected" @endif>{{ $i }}</option>
                          @endfor
                        </select>
                      </div>
                      <div class="col-sm-4">
                        <select id="month" name="month" class="form-control" onchange="setDays(this,day,year)" >
                          {{ $last= 1 }}
                          {{ $now = 12 }}

                          @for ($i = 1; $i <= 12; $i++)
                          <option value="{{ $i }}" @if (old('month') == $i) selected="selected" @endif>{{ $i }}</option>
                          @endfor
                        </select>
                      </div>
                      <div class="col-sm-4">
                        <select id="year" name="year" class="form-control" onchange="setDays(month,day,this)" >
                          {{ $last= date('Y')-120 }}
                          {{ $now = date('Y') }}

                          @for ($i = $last; $i <= $now; $i++)
                          <option value="{{ $i }}" @if (old('year') == $i) selected="selected" @endif>{{ $i }}</option>
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
                      <option value="male" @if (old('gender') == 'male') selected="selected" @endif>Male</option>
                      <option value="female" @if (old('gender') == 'female') selected="selected" @endif>Female</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label >Fee</label>
                    <input type="text" class="form-control" placeholder="Fee" name="fee" value="{{ old('fee') }}">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="required">Class</label>
                    <select class="form-control" name="class">
                      <option value="" selected>Please select</option>
                      @foreach($classes as $class)
                      @if (old('class') == $class->id)
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
                    <textarea class="form-control" name="address" placeholder="Enter ...">{{ old('address') }}</textarea>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="description" placeholder="Enter ...">{{ old('description') }}</textarea>
                  </div>
                </div>
              </div>
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

  var numDays = {
    '01': 31,
    '02': 28,
    '03': 31,
    '04': 30,
    '05': 31,
    '06': 30,
    '07': 31,
    '08': 31,
    '09': 30,
    '10': 31,
    '11': 30,
    '12': 31
  };

  function setDays(oMonthSel, oDaysSel, oYearSel) {

    var nDays, oDaysSelLgth, opt, i = 1;
    nDays = numDays[oMonthSel[oMonthSel.selectedIndex].value];
    if (nDays == 28 && oYearSel[oYearSel.selectedIndex].value % 4 == 0)
      ++nDays;
    oDaysSelLgth = oDaysSel.length;
    if (nDays != oDaysSelLgth) {
      if (nDays < oDaysSelLgth)
        oDaysSel.length = nDays;
      else
        for (i; i < nDays - oDaysSelLgth + 1; i++) {
          opt = new Option(oDaysSelLgth + i, oDaysSelLgth + i);
          oDaysSel.options[oDaysSel.length] = opt;
        }
    }
    var oForm = oMonthSel.form;
    var month = oMonthSel.options[oMonthSel.selectedIndex].value;
    var day = oDaysSel.options[oDaysSel.selectedIndex].value;
    var year = oYearSel.options[oYearSel.selectedIndex].value;

    var DateOfBirth = year + '-' + month + '-' + day;
    dob1 = new Date(DateOfBirth);
    var today = new Date();
    var age = Math.floor((today - dob1) / (365.25 * 24 * 60 * 60 * 1000));
    $("#age-txt").val(age);

    //oForm.datepicker.value = year + '-' + month + '-' + day;
  }

  function calculateDOB(age) {
    var db = new Date();
    var CurrentYear = db.getFullYear();
    var BirthYear = CurrentYear - age;
    $("#year").val(BirthYear);
  }
</script>

@stop