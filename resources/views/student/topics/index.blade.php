@extends('layouts.student')
@section('title', 'Alpha Academy | Topics')
@section('css_scripts')
@stop
@section('content')
<!doctype html>
<!-- breadcrum -->
<section class="w3l-skill-breadcrum">
  <div class="breadcrum">
    <div class="container">
      <p><a href="{{route('student/dashboard')}}">Home</a> &nbsp; / &nbsp; Topics</p>
    </div>
  </div>
</section>
<!-- //breadcrum -->

<!-- //stats -->
<section class="w3l-courses">
  <div class="blog py-5" id="courses">
    <div class="container py-lg-5">
      <div class="header-section text-center">
        <h3 class="mb-2">Various Topics to choose from</h3>
      </div>
      
      <div class="row mt-md-5 mt-4">
        <div class="col-md-12 mx-auto">
          <div class="owl-two owl-carousel owl-theme">
            @foreach($topics as $key=>$topic)
            <div class="item">
              <div class="card">
                <div class="card-header p-0 position-relative">
                  <a href="{{ route('student/contents',['topic_id' => $topic->enc_topid]) }}" class="zoom d-block">
                    <img class="card-img-bottom d-block" src="{{ asset('thumb_nail/topic/'.$topic->thumb_nail  )}}" alt="Card image cap">
                  </a>
                  <div class="author">
                    <div class="course-title">
                      <a href="{{ route('student/contents',['topic_id' => $topic->enc_topid]) }}">{{ $topic->name }}</a>
                    </div>
                  </div>
                </div>
                <div class="card-body course-details">
                  <a href="{{ route('student/contents',['topic_id' => $topic->enc_topid]) }}" class="course-desc"> {!! nl2br($topic->description) !!}</a>
                </div>
              </div>              
            </div>
                  @endforeach

            
               
          </div>
        </div>
      </div>

    </div>
  </div>
</section>
@endsection

@section('scripts')

@stop