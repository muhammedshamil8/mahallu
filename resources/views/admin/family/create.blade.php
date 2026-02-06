@extends('layouts.admin')
@section('title', 'Noble Mahallu | Create Family')
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
          <h1>Add</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('families.index')}}">Home</a></li>
            <li class="breadcrumb-item active">Families</li>
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
                  <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Families</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link disabled" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Members</a>
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
              <div class="tab-content" id="custom-tabs-three-tabContent">
                <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">

                  <form method="post" action="{{ route('families.store') }}">
                    @csrf
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label>കുടുംബനാഥൻ
                            <i class="fa fa-asterisk" style="color:red"></i></label>
                            <input type="text" class="form-control" placeholder="Head of family" name="head_of_family" value="{{ old('head_of_family') }}">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>വീടിന്റെ പേര്</label>
                            <input type="text" class="form-control" placeholder="House name" name="house_name" value="{{ old('house_name') }}">
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>വീട്ട് നമ്പർ</label>
                            <input type="text" class="form-control" placeholder="House number" name="house_number" value="{{ old('house_number') }}">
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>പറമ്പിന്റെ പേര്</label>
                            <input type="text" class="form-control" placeholder="Name of field" name="name_of_field" value="{{ old('name_of_field') }}">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Mobile Number</label>
                            <input type="text" class="form-control" placeholder="Mobile Number" name="mobile_number" value="{{ old('mobile_number') }}">
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>WhatsApp Number</label>
                            <input type="text" class="form-control" placeholder="WhatsApp number" name="whatsapp_number" value="{{ old('whatsapp_number') }}">
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Pin Code</label>
                            <input type="text" class="form-control" placeholder="Pin Number" name="pin_number" value="{{ old('pin_number') }}">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>വാർഡ് നമ്പർ</label>
                            <input type="text" class="form-control" placeholder="Ward number" name="ward_no" value="{{ old('ward_no') }}">
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>സ്ഥലം(സെന്റ്)</label>
                            <input type="text" class="form-control" placeholder="Area of land" name="area_of_land" value="{{ old('area_of_land') }}">
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>സ്ഥലം</label>
                            <input type="text" class="form-control" placeholder="Place" name="place" value="{{ old('place') }}">
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Districts</label>
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
                        <div class="col-sm-2">
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
                      </div>
                      <div class="row">
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Type of house</label>
                            <select class="form-control" name="type_of_house">
                              <option value="" disabled selected>Please select</option>
                              @foreach($house_types as $house_type)
                              @if (old('type_of_house') == $house_type->id)
                              <option value="{{ $house_type->id }}" selected>{{ $house_type->name }}</option>
                              @else
                              <option value="{{ $house_type->id }}">{{ $house_type->name }}</option>
                              @endif
                              @endforeach
                            </select>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>കിണർ</label>
                            <select class="form-control" name="well">
                              <option value="" disabled selected>Please select</option>
                              <option value="1" @if (old('well') == '1') selected="selected" @endif>Yes</option>
                              <option value="0" @if (old('well') == '0') selected="selected" @endif>No</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Water connection</label>
                            <select class="form-control" name="water_connection">
                              <option value="" disabled selected>Please select</option>
                              <option value="1" @if (old('water_connection') == '1') selected="selected" @endif>Yes</option>
                              <option value="0" @if (old('water_connection') == '0') selected="selected" @endif>No</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Gas</label>
                            <select class="form-control" name="gas">
                              <option value="" disabled selected>Please select</option>
                              <option value="1" @if (old('gas') == '1') selected="selected" @endif>Yes</option>
                              <option value="0" @if (old('gas') == '0') selected="selected" @endif>No</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>റേഷൻ കാർഡ്</label>
                            <select class="form-control" name="ration_card">
                              <option value="" disabled selected>Please select</option>
                              @foreach($ration_cards as $ration_card)
                              @if (old('ration_card') == $ration_card->id)
                              <option value="{{ $ration_card->id }}" selected>{{ $ration_card->name }}</option>
                              @else
                              <option value="{{ $ration_card->id }}">{{ $ration_card->name }}</option>
                              @endif
                              @endforeach
                            </select>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>റേഷൻ കാർഡ് നമ്പർ</label>
                            <input type="text" class="form-control" placeholder="Ration card number" name="ration_card_no" value="{{ old('ration_card_no') }}">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>വീടിന്റെ ഉടമസ്ഥത</label>
                            <select class="form-control" name="house_ownership">
                              <option value="" disabled selected>Please select</option>
                              @foreach($house_ownerships as $house_ownership)
                              @if (old('house_ownership') == $house_ownership->id)
                              <option value="{{ $house_ownership->id }}" selected>{{ $house_ownership->name }}</option>
                              @else
                              <option value="{{ $house_ownership->id }}">{{ $house_ownership->name }}</option>
                              @endif
                              @endforeach
                            </select>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>House owner name(NA for own hose)</label>
                            <input type="text" class="form-control" placeholder="House owner name" name="house_owner_name" value="{{ old('house_owner_name') }}">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>സാമ്പത്തിക സ്ഥിതി</label>
                            <select class="form-control" name="financial_status">
                              <option value="" disabled selected>Please select</option>
                              @foreach($financial_statoos as $financial_status)
                              @if (old('financial_status') == $financial_status->id)
                              <option value="{{ $financial_status->id }}" selected>{{ $financial_status->name }}</option>
                              @else
                              <option value="{{ $financial_status->id }}">{{ $financial_status->name }}</option>
                              @endif
                              @endforeach
                            </select>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>വാഹനങ്ങൾ<i class="fa fa-asterisk" style="color:red"></i></label>
                            <select class="select2" multiple="multiple" data-placeholder="Select a vehicle" style="width: 100%;" name="vehicles[]">
                              @foreach($vehicles as $vehicle)
                              @if (old('vehicles'))
                              <option value="{{ $vehicle->id }}" {{ in_array($vehicle->id, old('vehicles')) ? 'selected' : '' }}>{{ $vehicle->name }}</option>
                              @else
                              <option value="{{ $vehicle->id }}" {{ $vehicle->id ==1 ? 'selected' : '' }}>{{ $vehicle->name }}</option>
                              @endif
                              @endforeach

                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>വരിസംഖ്യ നൽകുന്ന പള്ളികൾ <i class="fa fa-asterisk" style="color:red"></i></label>
                            <select class="select2" multiple="multiple" data-placeholder="Select a Masjid" style="width: 100%;" name="favorite_masjid[]">
                              @foreach($masjids as $masjid)
                              @if (old('favorite_masjid'))
                              <option value="{{ $masjid->id }}" {{ in_array($masjid->id, old('favorite_masjid')) ? 'selected' : '' }}>{{ $masjid->name }}</option>
                              @else
                              <option value="{{ $masjid->id }}" {{ $masjid->id ==1 ? 'selected' : '' }}>{{ $masjid->name }}</option>
                              @endif
                              @endforeach

                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>ഇലക്ട്രിക്ക് പോസ്റ്റ് നമ്പർ</label>
                            <input type="text" class="form-control" placeholder="Post number" name="post_no" value="{{ old('post_no') }}">
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>പ്രധാന റോഡിലേക്കുള്ള വഴി അടയാളം</label>
                            <input type="text" class="form-control" placeholder="Land mark" name="land_mark" value="{{ old('land_mark') }}">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>Description</label>
                            <input type="text" class="form-control" placeholder="If you have any notes..." name="description" value="{{ old('description') }}">
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                      </div>
                    </form> 
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
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()



  })
  
  
</script>
@stop