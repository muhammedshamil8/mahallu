@extends('layouts.admin')
@section('title', 'Noble Mahallu | Show Member Report')
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
            <li class="breadcrumb-item"><a href="{{ route('families.index') }}">Home</a></li>
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
        <h3 class="card-title">Show Member</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
            </div>
          </div>
          <div class="card-body">
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label>പേര്</label>
                    <input type="text" class="form-control" placeholder="Name" name="name" value="{{ $member->name }}">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label>കുടുബമ്പനാഥനുമായുള്ള ബന്ധം</label>
                    <select class="form-control" name="relation">
                      <option value="" disabled selected>Please select</option>
                      @foreach($relations as $relation)
                      @if ($member->relation_id == $relation->id)
                      <option value="{{ $relation->id }}" selected>{{ $relation->name }}</option>
                      @else
                      <option value="{{ $relation->id }}">{{ $relation->name }}</option>
                      @endif
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label>പിതാവിന്റെ /ഭർത്താവിന്റെ പേര് </label>
                    <input type="text" class="form-control" placeholder="Father/Husband Name" name="father_name" value="{{ $member->father_name }}">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-9">
                  <div class="form-group">
                    <label>ജനനതിയ്യതി  </label>
                    <div class="row">
                      <div class="col-sm-4">
                        <select id="year" name="year" class="form-control ">
                          {{ $last= date('Y')-120 }}
                          {{ $now = date('Y') }}

                          @for ($i = $last; $i <= $now; $i++)
                          <option value="{{ $i }}" @if ($year == $i) selected="selected" @endif>{{ $i }}</option>
                          @endfor
                        </select>
                      </div>
                      <div class="col-sm-4">
                        <select id="month" name="month" class="form-control ">
                          {{ $last= 1 }}
                          {{ $now = 12 }}

                          @for ($i = 1; $i <= 12; $i++)
                          <option value="{{ $i }}" @if ($month == $i) selected="selected" @endif>{{ $i }}</option>
                          @endfor
                        </select>
                      </div>
                      <div class="col-sm-4">
                        <select id="day" name="day" class="form-control ">
                          {{ $last= 31 }}
                          {{ $now = 1 }}

                          @for ($i = $now; $i <= $last; $i++)
                          <option value="{{ $i }}" @if ($day == $i) selected="selected" @endif>{{ $i }}</option>
                          @endfor
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label>Age </label>
                    <input type="text" class="form-control" placeholder="Age" onBlur="calculateDOB(this.value)">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label>Mobile </label>
                    <input type="text" class="form-control" placeholder="Mobile" name="mobile" value="{{ $member->mobile }}">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label>Whatsapp </label>
                    <input type="text" class="form-control" placeholder="Whatsapp" name="whatsapp" value="{{ $member->whatsapp }}">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label>Email </label>
                    <input type="text" class="form-control" placeholder="Email" name="email" value="{{ $member->email }}">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Gender</label>
                    <select class="form-control" name="gender">
                      <option value="" disabled selected>Please select</option>
                      <option value="M" @if ($member->gender == 'M') selected="selected" @endif>Male</option>
                      <option value="F" @if ($member->gender == 'F') selected="selected" @endif>Female</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Blood Group</label>
                    <select class="form-control" name="blood_group">
                      <option value="" disabled selected>Please select</option>
                      @foreach($blood_groups as $blood_group)
                      @if ($member->blood_group == $blood_group->id)
                      <option value="{{ $blood_group->id }}" selected>{{ $blood_group->name }}</option>
                      @else
                      <option value="{{ $blood_group->id }}">{{ $blood_group->name }}</option>
                      @endif
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>വോട്ടർ ഐഡി </label>
                    <input type="text" class="form-control" placeholder="Voter ID" name="id_card_no" value="{{ $member->id_card_no }}">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>ആധാർ </label>
                    <input type="text" class="form-control" placeholder="Aadhar No" name="aadhar_card_no" value="{{ $member->aadhar_card_no }}">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Education</label>
                    <select class="select2" multiple="multiple" data-placeholder="Select a education" style="width: 100%;" name="education[]">
                     @foreach($educations as $key => $education)
                     @if (array_key_exists($key, $memer_education_ids))
                     <option value="{{ $key }}" selected>{{ $education }}</option>
                     @else
                     <option value="{{ $key }}">{{ $education }}</option>
                     @endif
                     @endforeach
                   </select>
                 </div>
               </div>
               <div class="col-sm-6">
                <div class="form-group">
                  <label>Islamic Education</label>
                  <select class="select2" multiple="multiple" data-placeholder="Select a education" style="width: 100%;" name="islamic_education[]">
                    @foreach($islamic_educations as $key => $education)
                    @if (array_key_exists($key, $memer_islamic_education_ids))
                    <option value="{{ $key }}" selected>{{ $education }}</option>
                    @else
                    <option value="{{ $key }}">{{ $education }}</option>
                    @endif
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-4">
                <div class="form-group">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="is_finding_job" value="is_finding_job" @if($member->is_finding_job == 1 ) checked @endif>
                    <label class="form-check-label">ജോലി അനേഷിക്കുന്നുണ്ടോ</label>
                  </div>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="is_looking_marriage" value="is_looking_marriage" @if($member->is_looking_marriage == 1 ) checked @endif>
                    <label class="form-check-label">വിവാഹം അനേഷിക്കുന്നുണ്ടോ</label>
                  </div>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="is_name_in_voter_list" value="is_name_in_voter_list" @if($member->is_name_in_voter_list == 1 ) checked @endif>
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
                    @foreach($jobs as $key => $job)
                    @if (array_key_exists($key, $memer_job_ids))
                    <option value="{{ $key }}" selected>{{ $job }}</option>
                    @else
                    <option value="{{ $key }}">{{ $job }}</option>
                    @endif
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Job Place</label>
                  <input type="text" class="form-control" placeholder="Enter ..." name="job_place" value="{{ $member->job_place }}">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Marital Status</label>
                  <select class="form-control" name="marital_status_id">
                    <option value="" disabled selected>Please select</option>
                    @foreach($marital_statoos as $marital_status)
                    @if ($member->marital_status_id == $marital_status->id)
                    <option value="{{ $marital_status->id }}" selected>{{ $marital_status->name }}</option>
                    @else
                    <option value="{{ $marital_status->id }}">{{ $marital_status->name }}</option>
                    @endif
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Physical Status</label>
                  <select class="form-control" name="physical_status_id">
                    <option value="" disabled selected>Please select</option>
                    @foreach($physical_statoos as $physical_status)
                    @if ($member->physical_status_id == $physical_status->id)
                    <option value="{{ $physical_status->id }}" selected>{{ $physical_status->name }}</option>
                    @else
                    <option value="{{ $physical_status->id }}">{{ $physical_status->name }}</option>
                    @endif
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="exampleInputFile">Photo</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="exampleInputFile">
                      <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text" id="">Upload</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>വാഹനങ്ങൾ</label>
                  <select class="select2" multiple="multiple" data-placeholder="Select a vehicle" style="width: 100%;" name="vehicles[]">
                   @foreach($vehicles as $key => $vehicle)
                   @if (array_key_exists($key, $memer_vehicle_ids))
                   <option value="{{ $key }}" selected>{{ $vehicle }}</option>
                   @else
                   <option value="{{ $key }}">{{ $vehicle }}</option>
                   @endif
                   @endforeach
                 </select>
               </div>
             </div>
           </div>
           <div class="row">
            <div class="col-sm-12">
              <!-- textarea -->
              <div class="form-group">
                <label>ആരോഗ്ഗ്യ വിവരങ്ങൾ </label>
                <input type="text" class="form-control" placeholder="Health infomation" name="health_info" value="{{ $member->health_info }}">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <!-- textarea -->
              <div class="form-group">
                <label>ഗവണ്മെന്റ് സഹായങ്ങൾ </label>
                <input type="text" class="form-control" placeholder="Government help information" name="gov_help_info" value="{{ $member->gov_help_info }}">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label>Description</label>
                <input type="text" class="form-control" placeholder="If you have any notes..." name="description" value="{{ $member->description }}">
              </div>
            </div>
          </div>
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
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()


  })
  function calculateDOB(age){
    var db= new Date();
    var CurrentYear = db.getFullYear();
    var BirthYear = CurrentYear - age;
    $("#year").val(BirthYear);
  }
</script>

@stop