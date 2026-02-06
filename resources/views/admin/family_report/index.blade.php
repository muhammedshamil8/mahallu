@extends('layouts.admin')
@section('title', 'Noble Mahallu | Family Report')
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
          <h1>Family Report</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('family_reports.index') }}">Home</a></li>
            <li class="breadcrumb-item active">Family Report</li>
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
        <h3 class="card-title">Family Report</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
            </div>
          </div>
          <div class="card-body">
            <form method="post" action="{{ route('family_reports.store') }}" target="_blank">
              @csrf
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>കുടുംബനാഥൻ</label>
                    <input type="text" class="form-control" placeholder="Head of family" name="head_of_family" >
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>വീടിന്റെ പേര്</label>
                    <input type="text" class="form-control" placeholder="House name" name="house_name" >
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>വീട്ട് നമ്പർ</label>
                    <input type="text" class="form-control" placeholder="House number" name="house_number" >
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>പറമ്പിന്റെ പേര്</label>
                    <input type="text" class="form-control" placeholder="Name of field" name="name_of_field" >
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Mobile Number</label>
                    <input type="text" class="form-control" placeholder="Mobile Number" name="mobile_number" >
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>WhatsApp Number</label>
                    <input type="text" class="form-control" placeholder="WhatsApp Number" name="whatsapp_number" >
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Pin Code</label>
                    <input type="text" class="form-control" placeholder="Pin Code" name="pin_number" >
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>വാർഡ് നമ്പർ</label>
                    <input type="text" class="form-control" placeholder="Ward number" name="ward_no" >
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>എത്ര സെന്റ് സ്ഥലം മുതൽ </label>
                    <select id="day" name="from_cent" class="form-control ">
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
                    <label>എത്ര സെന്റ് സ്ഥലം വരെ </label>
                    <select id="day" name="to_cent" class="form-control ">
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
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>സ്ഥലം</label>
                    <input type="text" class="form-control" placeholder="Place" name="place" >
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>ജില്ല</label>
                    <select class="form-control" name="district">
                            <option value="" disabled selected>Please select</option>
                            @foreach($district as $district)
                            @if (old('district') == $district->id)
                            <option value="{{ $district->id }}" selected>{{ $district->name }}</option>
                            @else
                            <option value="{{ $district->id }}">{{ $district->name }}</option>
                            @endif
                            @endforeach
                          </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Relegion</label>
                          <select class="form-control" name="relegion">
                            <option value="" disabled selected>Please select</option>
                            @foreach($relegion as $relegion)
                            @if (old('relegion') == $relegion->id)
                            <option value="{{ $relegion->id }}" selected>{{ $relegion->name }}</option>
                            @else
                            <option value="{{ $relegion->id }}">{{ $relegion->name }}</option>
                            @endif
                            @endforeach
                          </select>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Type of house</label>
                    <select class="select2" multiple="multiple" data-placeholder="Select a Type of house" style="width: 100%;" name="type_of_house[]">
                      @foreach($house_types as $house_type)
                      <option value="{{ $house_type->id }}" >{{ $house_type->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label>കിണർ</label>
                    <select class="form-control" name="well">
                      <option value="" disabled selected>Please select</option>
                      <option value="1" >Yes</option>
                      <option value="0" >No</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label>Water connection</label>
                    <select class="form-control" name="water_connection">
                      <option value="" disabled selected>Please select</option>
                      <option value="1" >Yes</option>
                      <option value="0" >No</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label>Gas</label>
                    <select class="form-control" name="gas">
                      <option value="" disabled selected>Please select</option>
                      <option value="1" >Yes</option>
                      <option value="0" >No</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>റേഷൻ കാർഡ്</label>
                    <select class="select2" multiple="multiple" data-placeholder="Select a card" style="width: 100%;" name="ration_card[]">
                      @foreach($ration_cards as $ration_card)
                      <option value="{{ $ration_card->id }}" >{{ $ration_card->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>റേഷൻ കാർഡ് നമ്പർ</label>
                    <input type="text" class="form-control" placeholder="Ration card number" name="ration_card_no" >
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>വീടിന്റെ ഉടമസ്ഥത</label>
                    <select class="select2" multiple="multiple" data-placeholder="Select a ownership" style="width: 100%;" name="house_ownership[]">
                      @foreach($house_ownerships as $house_ownership)
                      <option value="{{ $house_ownership->id }}" >{{ $house_ownership->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>House owner name</label>
                    <input type="text" class="form-control" placeholder="House owner name" name="house_owner_name" >
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>സാമ്പത്തിക സ്ഥിതി</label>
                    <select class="select2" multiple="multiple" data-placeholder="Select a financial status" style="width: 100%;" name="financial_status[]">
                      @foreach($financial_statoos as $financial_status)
                      <option value="{{ $financial_status->id }}" >{{ $financial_status->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>വാഹനങ്ങൾ</label>
                    <select class="select2" multiple="multiple" data-placeholder="Select a vehicle" style="width: 100%;" name="vehicles[]">
                      @foreach($vehicles as $vehicle)
                      <option value="{{ $vehicle->id }}" >{{ $vehicle->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>വരിസംഖ്യ നൽകുന്ന പള്ളികൾ </label>
                    <input type="text" class="form-control" placeholder="Favorite masjid" name="favorite_masjid" >
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