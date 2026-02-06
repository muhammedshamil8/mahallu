@extends('layouts.admin')
@section('title', 'Noble Mahallu | Member Report')
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
          <h1>Member Report</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('member_reports.index') }}">Home</a></li>
            <li class="breadcrumb-item active">Member Report</li>
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
        <h3 class="card-title">Member Report</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
            </div>
          </div>
          <div class="card-body">
            <form method="post" action="{{ route('member_reports.store') }}" target="_blank">
              @csrf
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>പേര്</label>
                    <input type="text" class="form-control" placeholder="Name" name="name">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>പിതാവിന്റെ /ഭർത്താവിന്റെ പേര് </label>
                    <input type="text" class="form-control" placeholder="Father/Husband Name" name="father_name">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>From Age </label>
                    <select id="day" name="from_age" class="form-control ">
                      <option value="" >Please Select</option>
                      {{ $last= 100 }}
                      {{ $now = 1 }}

                      @for ($i = $now; $i <= $last; $i++)
                      <option value="{{ $i }}">{{ $i }}</option>
                      @endfor
                    </select>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>To Age </label>
                    <select id="day" name="to_age" class="form-control ">
                      <option value="" >Please Select</option>
                      {{ $last= 100 }}
                      {{ $now = 1 }}

                      @for ($i = $now; $i <= $last; $i++)
                      <option value="{{ $i }}" >{{ $i }}</option>
                      @endfor
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label>Mobile </label>
                    <input type="text" class="form-control" placeholder="Mobile" name="mobile" >
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label>Whatsapp </label>
                    <input type="text" class="form-control" placeholder="Whatsapp" name="whatsapp" >
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label>Email </label>
                    <input type="text" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Gender</label>
                    <select class="form-control" name="gender">
                      <option value="" disabled selected>Please select</option>
                      <option value="M" >Male</option>
                      <option value="F" >Female</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Blood Group</label>
                    <select class="select2" multiple="multiple" data-placeholder="Select a Blood Group" style="width: 100%;" name="blood_group[]">
                      @foreach($blood_groups as $blood_group)
                      <option value="{{ $blood_group->id }}" >{{ $blood_group->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>വോട്ടർ ഐഡി </label>
                    <input type="text" class="form-control" placeholder="Voter ID" name="id_card_no" >
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>ആധാർ </label>
                    <input type="text" class="form-control" placeholder="Aadhar No" name="aadhar_card_no" >
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Education</label>
                    <select class="select2" multiple="multiple" data-placeholder="Select a education" style="width: 100%;" name="education[]">
                      @foreach($educations as $education)
                      <option value="{{ $education->id }}" >{{ $education->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Islamic Education</label>
                    <select class="select2" multiple="multiple" data-placeholder="Select a education" style="width: 100%;" name="islamic_education[]">
                      @foreach($islamic_educations as $education)
                      <option value="{{ $education->id }}" >{{ $education->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="is_finding_job" value="is_finding_job" >
                      <label class="form-check-label">ജോലി അനേഷിക്കുന്നുണ്ടോ</label>
                    </div>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="is_looking_marriage" value="is_looking_marriage" >
                      <label class="form-check-label">വിവാഹം അനേഷിക്കുന്നുണ്ടോ</label>
                    </div>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="is_name_in_voter_list" value="is_name_in_voter_list" >
                      <label class="form-check-label">വോട്ടർ ലിസ്റ്റിൽ പേരുണ്ടോ</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Job</label>
                    <select class="select2" multiple="multiple" data-placeholder="Select a job" style="width: 100%;" name="job[]">
                      @foreach($jobs as $job)
                      <option value="{{ $job->id }}" >{{ $job->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Job Place</label>
                    <input type="text" class="form-control" placeholder="Enter ..." name="job_place" >
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Marital Status</label>
                    <select class="select2" multiple="multiple" data-placeholder="Select a Marital Status" style="width: 100%;" name="marital_status_id[]">
                      @foreach($marital_statoos as $marital_status)
                      <option value="{{ $marital_status->id }}" >{{ $marital_status->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Physical Status</label>
                    <select class="select2" multiple="multiple" data-placeholder="Select a Physical Status" style="width: 100%;" name="physical_status_id[]">
                      @foreach($physical_statoos as $physical_status)
                      <option value="{{ $physical_status->id }}" >{{ $physical_status->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>വാഹനങ്ങൾ</label>
                    <select class="select2" multiple="multiple" data-placeholder="Select a vehicle" style="width: 100%;" name="vehicles[]">
                      @foreach($vehicles as $vehicle)
                      <option value="{{ $vehicle->id }}">{{ $vehicle->name }}</option>
                      @endforeach

                    </select>
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
    bsCustomFileInput.init();
  });

  function calculateDOB(age){
    var db= new Date();
    var CurrentYear = db.getFullYear();
    var BirthYear = CurrentYear - age;
    $("#year").val(BirthYear);
  }
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()


  })
</script>

@stop