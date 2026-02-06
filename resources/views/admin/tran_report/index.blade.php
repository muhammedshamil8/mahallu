@extends('layouts.admin')
@section('title', 'Noble Mahallu | Transaction Report')
@section('css_scripts')
 <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
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
          <h1>Transaction Report</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Transaction Report</li>
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
        <h3 class="card-title">Transaction Report</h3>

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
            <form method="post" action="{{ route('tran_reports.store') }}" target="_blank">
              @csrf
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>From:</label>

                    <div class="col-sm-12">
                      <input class="form-control" type="date" name="from" value="{{ old('from')? old('from'):date('Y-m-d') }}">
                    </div>
                  <!-- /.input group -->
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>To:</label>

                    <div class="col-sm-12">
                      <input class="form-control" type="date" name="to" value="{{ old('to')? old('to'):date('Y-m-d') }}">
                    </div>
                  <!-- /.input group -->
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Towards</label>
                    <select class="form-control" name="towards">
                      <option value="" selected>Please select</option>
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
                    <label>Committe</label>
                    <select class="form-control" name="committee">
                      <option value="" selected>Please select</option>
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
                <div class="col-sm-6">
                <div class="form-group">
                  <label>Receiver</label>
                  <select class="form-control" name="receiver">
                    <option value="" selected>Please select</option>
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
                <div class="col-sm-6">
                <div class="form-group">
                  <label>Bank</label>
                  <select class="form-control" name="bank">
                    <option value="" selected>Please select</option>
                    @foreach($banks as $bank)
                    @if (old('bank') == $bank->id)
                    <option value="{{ $bank->id }}" selected>{{ $bank->name }}</option>
                    @else
                    <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                    @endif
                    @endforeach
                  </select>
                </div>
                </div>
              </div>

                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                           <label>Member</label>
                           <select class="form-control" name="member">
                              <option value="" selected>Please select</option>
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
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Donor</label>
                          <select class="form-control" name="donor">
                            <option value="" selected>Please select</option>
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
                    </div>

                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Staff</label>
                          <select class="form-control" name="staff">
                            <option value="" selected>Please select</option>
                            @foreach($staffs as $staff)
                            @if (old('staff') == $staff->id)
                            <option value="{{ $staff->id }}" selected>{{ $staff->name }}</option>
                            @else
                            <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                            @endif
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Shop</label>
                          <select class="form-control" name="shop">
                            <option value="" selected>Please select</option>
                            @foreach($shops as $shop)
                            @if (old('shop') == $shop->id)
                            <option value="{{ $shop->id }}" selected>{{ $shop->name }}</option>
                            @else
                            <option value="{{ $shop->id }}">{{ $shop->name }}</option>
                            @endif
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Account Type</label>
                          <select class="form-control" name="type">
                            <option value="" selected>Please select</option>
                            <option value="income" @if (old('type') == 'income') selected="selected" @endif>Income</option>
                            <option value="expense" @if (old('type') == 'expense') selected="selected" @endif>Expense</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Payment Mode</label>
                          <select class="form-control" name="mode">
                            <option value="" selected>Please select</option>
                            <option value="cashbtn" @if (old('mode') == 'cashbtn') selected="selected" @endif>Cash</option>
                            <option value="bankbtn" @if (old('mode') == 'bankbtn') selected="selected" @endif>Bank</option>
                            <option value="checkbtn" @if (old('mode') == 'checkbtn') selected="selected" @endif>Check</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Student</label>
                          <select class="form-control" name="student">
                            <option value="" selected>Please select</option>
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

<!-- InputMask -->
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<!-- date-range-picker -->
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>

<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js') }}"></script>
<!-- Page script -->
<script>
  $(function () {
    //Date range picker
    $('#reservation').daterangepicker({
      locale: {
            format: 'DD/MM/YYYY'
        }
    })
  })
</script>

@stop