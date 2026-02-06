@extends('layouts.student')
@section('title', 'Alpha Academy | Exam')
@section('css_scripts')
@stop
@section('content')
<!doctype html>
<!-- breadcrum -->
<section class="w3l-skill-breadcrum">
  <div class="breadcrum">
    <div class="container">
      <p><a href="{{route('student/dashboard')}}">Home</a> &nbsp; / &nbsp; Exam</p>
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
              <h3 class="card-title">  
                <div>Exam Ends in <span id="time">{{$exam->duration}}</span> minutes!
                </div>
              </h3>
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
            <div class="alert alert-info alert-dismissible">
                <h4><i class="icon fa fa-info"></i> {{$exam->name}}  </h4>
                Number of questions : {{$exam->question_count}}
              </div>
            @if(count($questions) > 0) 
            <form method="post" action="{{ route('tests.store') }}" name="test_form" id="test_form" >
              @csrf
              <?php $i = 1; ?>
              @foreach($questions as $question)
              @if ($i > 1) <hr /> @endif
              <div class="row">
                <div class="col-xs-12 form-group">
                  <div class="form-group">
                    <strong>Question {{ $i }}.<br />{!! nl2br($question->question_text) !!}</strong>

                    @if ($question->code_snippet != '')
                    <div class="code_snippet">{!! $question->code_snippet !!}</div>
                    @endif

                    <input type="hidden" name="questions[{{ $i }}]" value="{{ $question->id }}">
                    <input type="hidden" name="exam_id" value="{{ $question->exam_id }}">
                    <input type="hidden" id="duration" value="{{ $exam->duration }}">
                    @foreach($question->options as $option)
                    <br>
                    <label class="radio-inline">
                      <input
                      type="radio"
                      name="answers[{{ $question->id }}]"
                      value="{{ $option->id }}">
                      {{ $option->option }}
                    </label>
                    @endforeach
                  </div>
                </div>
              </div>
              <?php $i++; ?>
              @endforeach
              <div class="col-sm-2">
                <button type="submit" class="btn btn-primary btn-block">Submit Answers</button>
              </div>
            </form>
            @endif
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
@endsection

@section('scripts')
<script type="text/javascript">
///////////////////////////////////////////////////////
 function startTimer(duration, display) {
  var timer = duration, minutes, seconds;
  setInterval(function () {
    minutes = parseInt(timer / 60, 10)
    seconds = parseInt(timer % 60, 10);

    minutes = minutes < 10 ? "0" + minutes : minutes;
    seconds = seconds < 10 ? "0" + seconds : seconds;

    display.textContent = minutes + ":" + seconds;

    if (--timer < 0) {
      document.forms["test_form"].submit();
      //timer = duration;
    }
  }, 1000);
}
window.onload = function () {
  var duration = $("#duration").val()*60,
  display = document.querySelector('#time');
  startTimer(duration, display);
};
//////////////////////////////////////////////////////////

$(window).blur(function() {
    //do something
    //alert('blur');
    //document.forms["test_form"].submit();
  });
</script>
@stop