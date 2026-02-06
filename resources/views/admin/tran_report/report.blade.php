@extends('layouts.admin')
@section('title', 'Noble Mahallu | Transaction Report')
@section('css_scripts')
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
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
              <li class="breadcrumb-item"><a href="{{ route('tran_reports.index') }}">Home</a></li>
              <li class="breadcrumb-item active">Transaction Report</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- /.card -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Transaction Report</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
               <div class="col-sm-12">
                @if(session()->get('success'))
                <div class="alert alert-success">
                  {{ session()->get('success') }}  
                </div>
                @endif
              </div> 
              <div class="row">
                <div class="col-sm-8"><b>Transaction Between</b></div>
                <div class="col-sm-4">{{$start_date}} - {{$end_date}}</div>
              </div> <div class="row">
                <div class="col-sm-10"><b>Opening balance</b></div>
                <div class="col-sm-2">{{$opening_balance}}</div>
              </div> 
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Sl.No</th>
                    <th>Receipt No/Voucher No</th>
                    <th>Date</th>
                    <th>Name</th>
                    <th>Account Head</th>
                    <th>Committee</th>
                    <th>Amount</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $sum = $opening_balance; ?>
                  @foreach($trans as $tran)
                  <?php 
                        if($tran->transaction_type == 'income'){
                            $sum = $sum + $tran->amount; 
                        }else{
                            $sum = $sum - $tran->amount; 
                        }
                        ?>
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$tran->receipt_number}}</td>
                    <td>{{$tran->date}}</td>
                    <td>
                      @if($tran->transaction_type == 'income' )
                      @if($tran->received_from == 'member' )
                      {{$tran->member->name}}
                      @elseif($tran->received_from == 'donor' )
                      {{$tran->donor->name}}
                      @elseif($tran->received_from == 'student' )
                      {{$tran->student->name}}
                      @elseif($tran->received_from == 'other' )
                      {{$tran->received_from_other}}
                       @endif
                       @elseif($tran->transaction_type == 'expense' )
                       @if($tran->paid_to == 'staff' )
                      {{$tran->staff->name}}
                      @elseif($tran->paid_to == 'shop' )
                      {{$tran->shop->name}}
                      @elseif($tran->paid_to == 'other' )
                      {{$tran->paid_to_other}}
                       @endif
                       @endif
                    </td>
                    <td>{{$tran->account->name}}</td>
                    <td>{{$tran->committee->name}}</td>
                    <td>
                      @if($tran->transaction_type == 'income' )
                      <span style="color: green;" >+ {{$tran->amount}}</span>
                      @elseif($tran->transaction_type == 'expense' )
                      <span style="color: red;" >- {{$tran->amount}}</span>
                       @endif
                    </td>
                    <td>{{$sum}}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
               <div class="row">
                <div class="col-sm-10"><b>Closing balance</b></div>
                <div class="col-sm-2">{{$sum}}</div>
              </div> 
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
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
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js') }}"></script>
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
@stop