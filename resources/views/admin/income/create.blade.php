@extends('layouts.admin')
@section('title', 'Noble Mahallu | Manage Income')
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
          <h1>Manage Income</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('income.index') }}">Home</a></li>
            <li class="breadcrumb-item active">Income</li>
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
                  <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Income</a>
                </li>
             <!--   <li class="nav-item">
                  <a class="nav-link disabled" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Members</a>
                </li>-->
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

                  <form method="post" action="{{route('income.store')}}">
                    @csrf
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label>Receipt.No</label>
                          <input type="text" class="form-control" placeholder="Enter Receipt.No" name="receipt_number" value="{{ old('receipt_number') }}">
                        </div>
                      </div> 
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label >Date</label>
                          <div class="col-sm-12">
                            <input class="form-control" type="date" name="date" value="{{ old('date')? old('date'):date('Y-m-d') }}">
                          </div>
                        </div>
                      </div> 
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label>Amount<i class="fa fa-asterisk" style="color:red"></i></label>
                          <input type="text" class="form-control" placeholder="Enter Amount" name="amount" value="{{ old('amount') }}">
                        </div>
                      </div>
                    </div>

                    <div class="row">

                      <div class="col-sm-6">
                       <label>Received From<i class="fa fa-asterisk" style="color:red"></i></label><br>
                       <input type="radio" id="member" name="received_from" value="member" @if(old('received_from') == 'member' ) checked @endif>
                       <label for="member" >Member</label>
                       <input type="radio" id="donor" name="received_from" value="donor" @if(old('received_from') == 'donor' ) checked @endif>
                       <label for="donor" >Donor</label>
                       <input type="radio" id="student" name="received_from" value="student" @if(old('received_from') == 'student' ) checked @endif>
                       <label for="donor" >Student</label>
                       <input type="radio" id="other" name="received_from" value="other" @if(old('received_from') == 'other' ) checked @endif>
                       <label for="other" >Other</label>
                      </div>
                      <div class="col-sm-6" style="display: block;" id="member_div">
                        <div class="form-group">
                           <label>Member<i class="fa fa-asterisk" style="color:red"></i></label>
                           <select class="form-control" name="member">
                              <option value="" disabled selected>Please select</option>
                              @foreach($members as $member)
                              @if (old('member') == $member->id)
                              <option value="{{ $member->id }}" selected>{{ $member->name ."#". $member->house_name }}</option>
                              @else
                              <option value="{{ $member->id }}">{{ $member->name ."#". $member->house_name }}</option>
                              @endif
                              @endforeach
                            </select>
                        </div>
                      </div>
                      <div class="col-sm-6" style="display: none;" id="donor_div">
                        <div class="form-group">
                          <label>Donor<i class="fa fa-asterisk" style="color:red"></i></label>
                          <select class="form-control" name="donor">
                            <option value="" disabled selected>Please select</option>
                            @foreach($donors as $donor)
                            @if (old('donor') == $donor->id)
                            <option value="{{ $donor->id }}" selected>{{ $donor->name }}</option>
                            @else
                            <option value="{{ $donor->id }}">{{ $donor->name }}</option>
                            @endif
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-6" style="display: none;" id="student_div">
                        <div class="form-group">
                          <label>Student<i class="fa fa-asterisk" style="color:red"></i></label>
                          <select class="form-control" name="student">
                            <option value="" disabled selected>Please select</option>
                            @foreach($students as $student)
                            @if (old('student') == $student->id)
                            <option value="{{ $student->id }}" selected>{{ $student->name }}</option>
                            @else
                            <option value="{{ $student->id }}">{{ $student->name }}</option>
                            @endif
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-6" style="display: none;" id="other_div">
                        <div class="form-group">
                          <label>Other<i class="fa fa-asterisk" style="color:red"></i></label>
                          <input type="text" class="form-control" placeholder="Enter name" name="received_from_other" value="{{ old('received_from_other') }}">
                        </div>
                      </div>
                    </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Towards<i class="fa fa-asterisk" style="color:red"></i></label>
                    <select class="form-control" name="towards">
                      <option value="" disabled selected>Please select account head</option>
                      @foreach($account as $account)
                      @if (old('towards') == $account->id)
                      <option value="{{ $member->id }}" selected>{{ $account->name }}</option>
                      @else
                      <option value="{{ $account->id }}">{{ $account->name }}</option>
                      @endif
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Committe<i class="fa fa-asterisk" style="color:red"></i></label>
                    <select class="form-control" name="committee">
                      <option value="" disabled selected>Please select</option>
                      @foreach($committe as $committe)
                      @if (old('committee') == $committe->id)
                      <option value="{{ $committe->id }}" selected>{{ $committe->name }}</option>
                      @else
                      <option value="{{ $committe->id }}">{{ $committe->name }}</option>
                      @endif
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                 <label>Payement mode<i class="fa fa-asterisk" style="color:red"></i></label><br>
                 <input type="radio" id="cashbtn" name="payment_mode" value="cashbtn" @if(old('payment_mode') == 'cashbtn' ) checked @endif>
                 <label for="cashbtn" >Cash</label>

                 <input type="radio" id="bankbtn" name="payment_mode" value="bankbtn" @if(old('payment_mode') == 'bankbtn' ) checked @endif>
                 <label for="bankbtn" >Bank</label>
                 <input type="radio" id="checkbtn" name="payment_mode" value="checkbtn" @if(old('payment_mode') == 'checkbtn' ) checked @endif>
                 <label for="checkbtn" >Check</label><br>
               </div> 
               <div class="col-sm-8" style="display: block;" id="receiver_div">
                <div class="form-group">
                  <label>Receiver<i class="fa fa-asterisk" style="color:red"></i></label>
                  <select class="form-control" name="receiver">
                    <option value="" disabled selected>Please select</option>
                    @foreach($receiver as $receiver)
                    @if (old('receiver') == $receiver->id)
                    <option value="{{ $receiver->id }}" selected>{{ $receiver->name }}</option>
                    @else
                    <option value="{{ $receiver->id }}">{{ $receiver->name }}</option>
                    @endif
                    @endforeach
                  </select>
                </div>
              </div> 
              <div class="col-sm-8" style="display: none;" id="bank_div">

                <div class="form-group">
                  <label>Bank<i class="fa fa-asterisk" style="color:red"></i></label>
                  <select class="form-control" name="bank">
                    <option value="" disabled selected>Please select</option>
                    @foreach($banks as $bank)
                    @if (old('bank') == $bank->id)
                    <option value="{{ $bank->id }}" selected>{{ $bank->name }}</option>
                    @else
                    <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                    @endif
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label>Transaction Details<i class="fa fa-asterisk" style="color:red"></i></label>
                  <input type="text" class="form-control" placeholder="Enter Transaction Number" name="transaction_number" value="{{ old('transaction_number') }}">
                </div>
              </div>
              <div class="col-sm-8" style="display: none;" id="check_div">
                <div class="form-group">
                  <label>Check Details<i class="fa fa-asterisk" style="color:red"></i></label>
                  <textarea class="form-control" name="check_details" placeholder="Enter check number ,date,bank">{{ old('check_details') }}</textarea>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Description</label>
                  <textarea class="form-control" name="description" placeholder="Enter ...">{{ old('description') }}</textarea>
                </div>
              </div>
            </div>
            <input type="hidden" id="received_from_selected" value="{{ old('received_from') }}">
            <input type="hidden" id="payment_mode_selected" value="{{ old('payment_mode') }}">
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
<script type="text/javascript">
  $(document).ready(function () {
    var received_from = $('#received_from_selected').val();
    if(received_from == 'member'){
      $("#member_div").show();
      $("#donor_div").hide();
      $("#student_div").hide();
      $("#other_div").hide();
    }else if(received_from == 'donor'){
      $("#member_div").hide();
      $("#donor_div").show();
      $("#student_div").hide();
      $("#other_div").hide();
    }else if(received_from == 'student'){
      $("#member_div").hide();
      $("#donor_div").hide();
      $("#student_div").show();
      $("#other_div").hide();
    }else{
      $("#member_div").hide();
      $("#donor_div").hide();
      $("#student_div").hide();
      $("#other_div").show();
    }

    var payment_mode = $('#payment_mode_selected').val();
    if(payment_mode == 'cashbtn'){
      $("#receiver_div").show();
      $("#bank_div").hide();
      $("#check_div").hide();
    }else if(payment_mode == 'bankbtn'){
      $("#receiver_div").hide();
      $("#bank_div").show();
      $("#check_div").hide();
    }else{
      $("#receiver_div").hide();
      $("#bank_div").hide();
      $("#check_div").show();
    }
  });
  
  $("#member").click(function(){
    $("#member_div").show();
    $("#donor_div").hide();
    $("#student_div").hide();
    $("#other_div").hide();
  });
  $("#donor").click(function(){
    $("#donor_div").show();
    $("#member_div").hide();
    $("#student_div").hide();
    $("#other_div").hide();
  });
  $("#student").click(function(){
    $("#student_div").show();
    $("#member_div").hide();
    $("#donor_div").hide();
    $("#other_div").hide();
  });
  $("#other").click(function(){
    $("#other_div").show();
    $("#member_div").hide();
    $("#donor_div").hide();
    $("#student_div").hide();
  });

  $("#cashbtn").click(function(){
    $("#receiver_div").show();
    $("#bank_div").hide();
    $("#check_div").hide();
  });
  $("#bankbtn").click(function(){
    $("#receiver_div").hide();
    $("#bank_div").show();
    $("#check_div").hide();
  });
  $("#checkbtn").click(function(){
    $("#receiver_div").hide();
    $("#bank_div").hide();
    $("#check_div").show();
  });
</script>
@stop