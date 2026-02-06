@extends('layouts.student')
@section('title', 'Alpha Academy | Dashboard')
@section('css_scripts')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<style type="text/css">
  .test-option-true {
    background-color: green !important;
    color: white;
  }
  .test-option-false {
    background-color: red !important;
    color: white;
  }
</style>
@stop
@section('content')
<!doctype html>
<!-- breadcrum -->
<section class="w3l-skill-breadcrum">
  <div class="breadcrum">
    <div class="container">
      <p><a href="{{route('student/dashboard')}}">Home</a> &nbsp; / &nbsp; Lessons</p>
    </div>
  </div>
</section>
<!-- //breadcrum -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <!-- /.card -->

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Result</h3>
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
              <div class="col-md-12">
                <table class="table table-bordered table-striped">
                  
                  <tr>
                    <th>Date</th>
                    <td>{{ $test->created_at ?? '' }}</td>
                  </tr>
                  <tr>
                    <th>Result</th>
                    <td>{{ $test->result }}/10</td>
                  </tr>
                </table>
                <?php $i = 1 ?>
                @foreach($results as $result)
                <table class="table table-bordered table-striped">
                  <tr class="test-option{{ $result->correct ? '-true' : '-false' }}">
                    <th style="width: 10%">Question #{{ $i }}</th>
                    <th>{!! nl2br($result->question->question_text) ?? '' !!}</th>
                  </tr>
                  @if ($result->question->code_snippet != '')
                  <tr>
                    <td>Code snippet</td>
                    <td><div class="code_snippet">{!! $result->question->code_snippet !!}</div></td>
                  </tr>
                  @endif
                  <tr>
                    <td>Options</td>
                    <td>
                      <ul>
                        @foreach($result->question->options as $option)
                        <li style="@if ($option->correct == 1) font-weight: bold; @endif
                        @if ($result->option_id == $option->id) text-decoration: underline @endif">{{ $option->option }}
                        @if ($option->correct == 1) <em>(correct answer)</em> @endif
                        @if ($result->option_id == $option->id) <em>(your answer)</em> @endif
                      </li>
                      @endforeach
                    </ul>
                  </td>
                </tr>
                <tr>
                  <td>Answer Explanation</td>
                  <td>
                    {!! $result->question->answer_explanation  !!}
                    @if ($result->question->more_info_link != '')
                    <br>
                    <br>
                    Read more:
                    <a href="{{ $result->question->more_info_link }}" target="_blank">{{ $result->question->more_info_link }}</a>
                    @endif
                  </td>
                </tr>
              </table>
              <?php $i++ ?>
              @endforeach
            </div>
          </div>

          <p>&nbsp;</p>

          <a href="{{ route('student/contents', ['topic_id' => Crypt::encryptString($topic_id)]) }}" class="btn btn-default">Take another quiz</a>
          <a href="{{ route('results.index', ['exam_id' => Crypt::encryptString($exam_id)]) }}" class="btn btn-default">See all my results</a>

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
@endsection

@section('scripts')
<!-- DataTables -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
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