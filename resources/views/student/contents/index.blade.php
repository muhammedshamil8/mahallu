@extends('layouts.student')
@section('title', 'Alpha Academy | Lessons')
@section('css_scripts')
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

<div class="w3l-services1 pt-5" id="services">
  <div class="container pt-lg-3">
    <div class="aboutgrids row">
      <div class="col-lg-8 aboutgrid2">
        @if($cur_content == '')
        <h3 class="text-primary"><i class="fa fa-paint-brush"></i> {{$topic_desc['name']}}</h3>
        <p class="text-muted">{!! nl2br($topic_desc['short_description']) !!}</p>
        <p class="text-muted">{!! nl2br($topic_desc['description']) !!}</p>
        <br>
        @else
        <div class="container">
          <div class="row">
            <div class="col-sm-12">
              @if($cur_content->file_type == 'video')
              <div id="headerPopup" class="mfp-hide embed-responsive embed-responsive-21by9">
                @if($cur_content->type == 'disk_upload')
                <iframe class="embed-responsive-item" width="854" height="480" src="{{ asset('uploads/video/'.$cur_content->file_name ) }}" frameborder="0" allow=" encrypted-media" allowfullscreen></iframe>
                @elseif($cur_content->type == 'url')
                {!! $cur_content->video_html  !!}
                @elseif($cur_content->type == 'embeded_url')
                <iframe class="embed-responsive-item" width="854" height="480" src="{{ $cur_content->embeded_url }}" frameborder="0" allow=" encrypted-media" allowfullscreen></iframe>
                @endif
              </div>
              @elseif($cur_content->file_type == 'audio')
              @if($cur_content->type == 'disk_upload')
              <audio
              controls
              src="{{ asset('uploads/audio/'.$cur_content->file_name ) }}">
              Your browser does not support the
              <code>audio</code> element.
            </audio>
            @elseif($cur_content->type == 'embeded_url')
            <iframe class="embed-responsive-item" src="{{ $cur_content->embeded_url }}" frameborder="0" allowfullscreen=""></iframe>
            @endif
            @elseif($cur_content->file_type == 'docs')
            @if($cur_content->type == 'disk_upload')
            <a href="{{ asset('uploads/docs/'.$cur_content->file_name ) }}" class="btn btn-block btn-danger btn-flat" download>Download PDF file</a> 
            @elseif($cur_content->type == 'embeded_url')
            <div id="headerPopup" class="mfp-hide embed-responsive embed-responsive-21by9">
              <iframe class="embed-responsive-item" width="854" height="480" src="{{ $cur_content->embeded_url }}" frameborder="0" allow=" encrypted-media" allowfullscreen></iframe>
            </div>
            @endif
            @elseif($cur_content->file_type == 'image')
            @if($cur_content->type == 'disk_upload')
            <img src="{{ asset('uploads/image/'.$cur_content->file_name ) }}" class="responsive">
            @elseif($cur_content->type == 'embeded_url')
            <div class="embed-responsive embed-responsive-16by9">
              <iframe class="embed-responsive-item" src="{{ $cur_content->embeded_url }}" frameborder="0" allowfullscreen=""></iframe>
            </div>
            @endif
            @endif
          </div>
        </div>
        <div class="row">
          <div class="card-body">
            <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true">Description</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">Profile</a>
              </li>
            </ul>
            <div class="tab-content" id="custom-content-below-tabContent">
              <div class="tab-pane fade active show" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
               {!! nl2br($cur_content['description']) !!}
             </div>
             <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
               Mauris tincidunt mi at erat gravida, eget tristique urna bibendum. Mauris pharetra purus ut ligula tempor, et vulputate metus facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas sollicitudin, nisi a luctus interdum, nisl ligula placerat mi, quis posuere purus ligula eu lectus. Donec nunc tellus, elementum sit amet ultricies at, posuere nec nunc. Nunc euismod pellentesque diam. 
             </div>
           </div>
         </div>
       </div>
     </div>
     @endif
   </div>
   <div class="col-lg-4 aboutgrid1 my-lg-0 my-5">
    <h4>Recent Lessons</h4>
    @foreach($contents as $key=>$content)
    <div class="post" style="
    margin-bottom: 0px;
    padding-bottom: 0px;
    ">
    <div class="user-block" style="    margin-bottom: -18px;">
      <img class="img-circle img-bordered-sm" src="{{ asset('image/'.$content->file_type.'.png' ) }}" alt="user image" height="20" width="20">
      <span class="username">
        <a href="{{ route('student/contents',['topic_id' => $content->enc_topid,'content_id' => $content->enc_contid]) }}" ><b>{{ $content->title }}</b></a>
      </span>
    </div>
    <!-- /.user-block -->
    <p class="ArticleBody">
      {{ str_limit(strip_tags($content->description), 50) }}
      @if (strlen(strip_tags($content->description)) > 50)
      ... <a href="{{ route('student/contents',['topic_id' => $content->enc_topid,'content_id' => $content->enc_contid]) }}" >Read More</a>
      @endif
    </p>
  </div>
  @endforeach  
  @foreach($exams as $key=>$exam)
  
  @if($exam->publish_exam)
  <a href="{{ route('tests.create',['exam_id' => $exam->enc_exid]) }}" class="btn btn-primary">Attend Exam</a>
  @else
  <button type="button" class="btn btn-block btn-primary disabled">Exam Not Yet Published</button>
  @endif
  @if($exam->publish_result)
  <a href="{{ route('results.index',['exam_id' => $exam->enc_exid]) }}" class="btn btn-primary">View Result</a>
  @else
  <button type="button" class="btn btn-block btn-primary disabled">Result Not Yet Published</button>
  @endif
  @endforeach
  <a href="contact.html" class="btn btn-outline-secondary theme-button">Know More</a>
</div>
</div>
</div>

<div class="aboutbottom py-5">
  <div class="container py-lg-3">
    <div class="bottomgrids row no-gutters">
      <div class="col-lg-4 col-md-6 bottomgrid1 mt-lg-0 mt-0">
        <span class="fa fa-phone"></span>
        <h4><a class="service-title" href="#url">Free Call Support</a></h4>
        <p class="service-text">Donec et venenatis libero. Fusceing dapibus pulvinar tincidunt. Proin
        maximus ipsum ut scelerisque.</p>
      </div>
      <div class="col-lg-4 col-md-6 bottomgrid1 mt-md-0 mt-5">
        <span class="fa fa-users"></span>
        <h4><a class="service-title" href="#url">Highly Qualified Teachers</a></h4>
        <p class="service-text">Donec et venenatis libero. Fusceing dapibus pulvinar tincidunt. Proin
        maximus ipsum ut scelerisque.</p>
      </div>
      <div class="col-lg-4 col-md-6 bottomgrid1 mt-lg-0 mt-5">
        <span class="fa fa-book"></span>
        <h4><a class="service-title" href="#url">Book Library & Stores</a></h4>
        <p class="service-text">Donec et venenatis libero. Fusceing dapibus pulvinar tincidunt. Proin
        maximus ipsum ut scelerisque.</p>
      </div>
      <div class="col-lg-4 col-md-6 bottomgrid1 mt-5">
        <span class="fa fa-smile-o"></span>
        <h4><a class="service-title" href="#url">The best discount</a></h4>
        <p class="service-text">Donec et venenatis libero. Fusceing dapibus pulvinar tincidunt. Proin
        maximus ipsum ut scelerisque.</p>
      </div>
      <div class="col-lg-4 col-md-6 bottomgrid1 mt-5">
        <span class="fa fa-laptop"></span>
        <h4><a class="service-title" href="#url">Learn Courses Online</a></h4>
        <p class="service-text">Donec et venenatis libero. Fusceing dapibus pulvinar tincidunt. Proin
        maximus ipsum ut scelerisque.</p>
      </div>
      <div class="col-lg-4 col-md-6 bottomgrid1 mt-5">
        <span class="fa fa-phone"></span>
        <h4><a class="service-title" href="#url">Free Call Support</a></h4>
        <p class="service-text">Donec et venenatis libero. Fusceing dapibus pulvinar tincidunt. Proin
        maximus ipsum ut scelerisque.</p>
      </div>
      <div class="clearfix"> </div>
    </div>
  </div>
</div>
</div>
@endsection

@section('scripts')

@stop