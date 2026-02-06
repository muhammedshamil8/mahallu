@extends('layouts.admin')
@section('title', 'Noble Mahallu | Edit Expense')
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
          <h1>Manage Expense</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('expense.index') }}">Home</a></li>
            <li class="breadcrumb-item active">Expense</li>
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
                  <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Expense</a>
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

                  <form method="post" action="{{route('expense.update',$expense->id)}}">
                    @method('PATCH')
                    @csrf
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label>Voucher.No</label>
                          <input type="text" class="form-control" placeholder="Enter Voucher.No" name="receipt_number" value="{{ $expense->receipt_number }}">
                        </div>
                      </div> 
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label >Date</label>
                          <div class="col-sm-12">
                            <input class="form-control" type="date" name="date"value="{{Carbon\Carbon::parse($expense->date)->format('Y-m-d')}}" >
                          </div>
                        </div>
                      </div> 
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label>Amount<i class="fa fa-asterisk" style="color:red"></i></label>
                          <input type="text" class="form-control" placeholder="Enter Amount" name="amount" value="{{ $expense->amount }}">
                        </div>
                      </div>
                    </div>

                    <div class="row">

                      <div class="col-sm-6">
                       <label>Paid To<i class="fa fa-asterisk" style="color:red"></i></label><br>
                       <input type="radio" id="staff" name="paid_to" value="staff" @if($expense->paid_to == 'staff' ) checked @endif>
                       <label for="staff" >Staff</label>
                       <input type="radio" id="shop" name="paid_to" value="shop" @if($expense->paid_to == 'shop' ) checked @endif>
                       <label for="shop" >Shop</label>
                       <input type="radio" id="other" name="paid_to" value="other" @if($expense->paid_to == 'other' ) checked @endif>
                       <label for="other" >Other</label>
                     </div>
                     <div class="col-sm-6" style="display: block;" id="staff_div">
                      <div class="form-group">
                       <label>Staff<i class="fa fa-asterisk" style="color:red"></i></label>
                       <select class="form-control" name="staff">
                        <option value="" disabled selected>Please select</option>
                        @foreach($staffs as $staff)
                        @if ($expense->staff_id == $staff->id)
                        <option value="{{ $staff->id }}" selected>{{ $staff->name }}</option>
                        @else
                        <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                        @endif
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-6" style="display: none;" id="shop_div">
                    <div class="form-group">
                     <label>Shop<i class="fa fa-asterisk" style="color:red"></i></label>
                     <select class="form-control" name="shop">
                      <option value="" disabled selected>Please select</option>
                      @foreach($shops as $shop)
                      @if ($expense->shop_id == $shop->id)
                      <option value="{{ $shop->id }}" selected>{{ $shop->name }}</option>
                      @else
                      <option value="{{ $shop->id }}">{{ $shop->name }}</option>
                      @endif
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-sm-6" style="display: none;" id="other_div">
                  <div class="form-group">
                    <label>Other<i class="fa fa-asterisk" style="color:red"></i></label>
                    <input type="text" class="form-control" placeholder="Enter name" name="paid_to_other" value="{{ $expense->paid_to_other }}">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Towards<i class="fa fa-asterisk" style="color:red"></i></label>
                    <select class="form-control" name="towards">
                      <option value="" disabled selected>Please select account head</option>
                      @foreach($accounts as $account)
                      @if ($expense->towards_id == $account->id)
                      <option value="{{ $account->id }}" selected>{{ $account->name }}</option>
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
                      @if ($expense->committee_id == $committe->id)
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
                 <input type="radio" id="cashbtn" name="payment_mode" value="cashbtn" @if($expense->payment_mode == 'cashbtn' ) checked @endif>
                 <label for="cashbtn" >Cash</label>

                 <input type="radio" id="bankbtn" name="payment_mode" value="bankbtn" @if($expense->payment_mode == 'bankbtn' ) checked @endif>
                 <label for="bankbtn" >Bank</label>
                 <input type="radio" id="checkbtn" name="payment_mode" value="checkbtn" @if($expense->payment_mode == 'checkbtn' ) checked @endif>
                 <label for="checkbtn" >Check</label><br>
               </div> 
               <div class="col-sm-8" style="display: block;" id="receiver_div">
                <div class="form-group">
                  <label>Payer<i class="fa fa-asterisk" style="color:red"></i></label>
                  <select class="form-control" name="payer">
                    <option value="" disabled selected>Please select</option>
                    @foreach($receivers as $receiver)
                    @if ($expense->payer_id == $receiver->id)
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
                    @if ($expense->bank_id == $bank->id)
                    <option value="{{ $bank->id }}" selected>{{ $bank->name }}</option>
                    @else
                    <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                    @endif
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label>Transaction Number<i class="fa fa-asterisk" style="color:red"></i></label>
                  <input type="text" class="form-control" placeholder="Enter Transaction Number" name="transaction_number" value="{{ $expense->transaction_number }}">
                </div>
              </div>
              <div class="col-sm-8" style="display: none;" id="check_div">
                <div class="form-group">
                  <label>Check Details<i class="fa fa-asterisk" style="color:red"></i></label>
                  <textarea class="form-control" name="check_details" placeholder="Enter check number ,date,bank">{{ $expense->check_details }}</textarea>
                </div>
                <div class="form-group">
                  <label>Bank Name<i class="fa fa-asterisk" style="color:red"></i></label>
                  <input type="text" class="form-control" placeholder="Enter Bank Name" name="check_bank_name" value="{{ $expense->check_bank_name }}">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Description</label>
                  <textarea class="form-control" name="description" placeholder="Enter ...">{{ $expense->description }}</textarea>
                </div>
              </div>
            </div>
            <input type="hidden" id="paid_to_selected" value="{{$expense->paid_to}}">
            <input type="hidden" id="payment_mode_selected" value="{{$expense->payment_mode}}">
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
    var paid_to = $('#paid_to_selected').val();
    if(paid_to == 'staff'){
      $("#staff_div").show();
      $("#shop_div").hide();
      $("#other_div").hide();
    }else if(paid_to == 'shop'){
      $("#staff_div").hide();
      $("#shop_div").show();
      $("#other_div").hide();
    }else{
      $("#staff_div").hide();
      $("#shop_div").hide();
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

  $("#staff").click(function(){
    $("#staff_div").show();
    $("#shop_div").hide();
    $("#other_div").hide();
  });
  $("#shop").click(function(){
    $("#shop_div").show();
    $("#staff_div").hide();
    $("#other_div").hide();
  });
  $("#other").click(function(){
    $("#other_div").show();
    $("#staff_div").hide();
    $("#shop_div").hide();
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