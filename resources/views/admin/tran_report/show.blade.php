@extends('layouts.admin')
@section('title', 'Noble Mahallu | Show Family Report')
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
          <h1>Show</h1>
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
    <div class="container-fluid">
      <!-- /.card -->
      <div class="row">
        <div class="col-12 col-sm-12">
          <div class="card card-primary card-outline card-tabs">
            <div class="card-header p-0 pt-1 border-bottom-0">
              <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Families</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Members</a>
                </li>
              </ul>
            </div>
            <div class="card-body">
             <div class="col-sm-12">
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
            </div>
            <div class="tab-content" id="custom-tabs-three-tabContent">
              <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">

                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label>കുടുംബനാഥൻ</label>
                      <input type="text" class="form-control" placeholder="Head of family" name="head_of_family" value="{{ $family->head_of_family }}">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>വീടിന്റെ പേര്</label>
                      <input type="text" class="form-control" placeholder="House name" name="house_name" value="{{ $family->house_name }}">
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>വീട്ട് നമ്പർ</label>
                      <input type="text" class="form-control" placeholder="House number" name="house_number" value="{{ $family->house_number }}">
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>പറമ്പിന്റെ പേര്</label>
                      <input type="text" class="form-control" placeholder="Name of field" name="name_of_field" value="{{ $family->name_of_field }}">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>Mobile Number</label>
                      <input type="text" class="form-control" placeholder="Mobile Number" name="mobile_number" value="{{ $family->mobile_number }}">
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>WhatsApp Number</label>
                      <input type="text" class="form-control" placeholder="WhatsApp number" name="whatsapp_number" value="{{ $family->whatsapp_number }}">
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>Pin Code</label>
                      <input type="text" class="form-control" placeholder="Pin Number" name="pin_number" value="{{ $family->pin_number }}">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-2">
                    <div class="form-group">
                      <label>വാർഡ് നമ്പർ</label>
                      <input type="text" class="form-control" placeholder="Ward number" name="ward_no" value="{{ $family->ward_no }}">
                    </div>
                  </div>
                    <div class="col-sm-2">
                      <div class="form-group">
                        <label>സ്ഥലം(സെന്റ്)</label>
                        <input type="text" class="form-control" placeholder="Area of land" name="area_of_land" value="{{ $family->area_of_land }}">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>സ്ഥലം</label>
                        <input type="text" class="form-control" placeholder="Place" name="place" value="{{ $family->place }}">
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <div class="form-group">
                        <label>ജില്ല </label>
                        <select class="form-control" name="district">
                          <option value="" disabled selected>Please select</option>
                          @foreach($district as $district)
                          @if ($family->district == $district->id)
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
                          @if ($family->relegion == $relegion->id)
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
                        @if ($family->type_of_house == $house_type->id)
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
                        @if ($family->well == 1)
                        <option value="1" selected>Yes</option>
                        <option value="0" >No</option>
                        @else
                        <option value="1" >Yes</option>
                        <option value="0" selected>No</option>
                        @endif
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>Water connection</label>
                      <select class="form-control" name="water_connection">
                        <option value="" disabled selected>Please select</option>
                        @if ($family->water_connection == 1)
                        <option value="1" selected>Yes</option>
                        <option value="0" >No</option>
                        @else
                        <option value="1" >Yes</option>
                        <option value="0" selected>No</option>
                        @endif
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>Gas</label>
                      <select class="form-control" name="gas">
                        <option value="" disabled selected>Please select</option>
                        @if ($family->gas == 1)
                        <option value="1" selected>Yes</option>
                        <option value="0" >No</option>
                        @else
                        <option value="1" >Yes</option>
                        <option value="0" selected>No</option>
                        @endif
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
                        @if ($family->ration_card == $ration_card->id)
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
                      <input type="text" class="form-control" placeholder="Ration card number" name="ration_card_no" value="{{ $family->ration_card_no }}">
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
                        @if ($family->house_ownership == $house_ownership->id)
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
                      <label>House owner name</label>
                      <input type="text" class="form-control" placeholder="House owner name" name="house_owner_name" value="{{ $family->house_owner_name }}">
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
                        @if ($family->financial_status == $financial_status->id)
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
                      <label>വാഹനങ്ങൾ</label>
                      <select class="select2" multiple="multiple" data-placeholder="Select a vehicle" style="width: 100%;" name="vehicles[]">
                       @foreach($vehicles as $key => $vehicle)
                       @if (array_key_exists($key, $family_vehicle_ids))
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
                  <div class="form-group">
                    <label>സ്ഥിരമായി ബെന്ധപെടാറുള്ള പള്ളി</label>
                    
                    <select class="select2" multiple="multiple" data-placeholder="Select a masjid" style="width: 100%;" name="favorite_masjid[]">
                       @foreach($masjids as $key => $masjid)
                       @if (array_key_exists($key, $family_masjid_ids))
                       <option value="{{ $key }}" selected>{{ $masjid }}</option>
                       @else
                       <option value="{{ $key }}">{{ $masjid }}</option>
                       @endif
                       @endforeach
                     </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>പോസ്റ്റ് നമ്പർ</label>
                    <input type="text" class="form-control" placeholder="Post number" name="post_no" value="{{ $family->post_no }}">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>പ്രധാന റോഡിലേക്കുള്ള വഴി അടയാളം</label>
                    <input type="text" class="form-control" placeholder="Land mark" name="land_mark" value="{{ $family->land_mark }}">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Description</label>
                    <input type="text" class="form-control" placeholder="If you have any notes..." name="description" value="{{ $family->description }}">
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">


              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Sl.No</th>
                    <th>Register ID</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Age</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($members as $member)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$member->id}}</td>
                    <td>{{$member->name}}</td>
                    <td>{{ $member->gender == 'M' ? 'Male' : 'Female' }}</td>
                    <td>{{$member->age}}</td>
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
    bsCustomFileInput.init();
  });
</script>
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
<script>
//redirect to specific tab
$(document).ready(function () {
  $('#custom-tabs-three-tab a[href="#{{ old('tab') }}"]').tab('show')
});
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()


  })
</script>
@stop