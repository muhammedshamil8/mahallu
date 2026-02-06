<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>@yield('title')</title>

  <!-- Google fonts -->
  <link href="//fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
  <link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&display=swap" rel="stylesheet">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/style-starter.css')}}">
  @yield('css_scripts')
</head>
<body>
  <!-- header -->
  <header class="w3l-header">
    <div class="hero-header-11">
      <div class="hero-header-11-content">
        <div class="container">
          <nav class="navbar navbar-expand-lg navbar-light py-md-2 py-0 px-0">
            <a class="navbar-brand" href="{{url('/')}}"><img src="{{ asset('assets/images/logo-icon.png')}}" alt="" />Alpha Academy</a>
          <!-- if logo is image enable this   
        <a class="navbar-brand" href="#index.html">
            <img src="image-path" alt="Your logo" title="Your logo" style="height:35px;" />
          </a> -->
          <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon fa icon-expand fa-bars"></span>
          <span class="navbar-toggler-icon fa icon-close fa-times"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            @guest
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @if (Route::has('register'))
            <li class="nav-item">
              <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
            @endif
            @else
            <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }} <span class="caret"></span>
              </a>

              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </div>
          </li>
          @endguest
        </ul>
      </div>
    </nav>
  </div>
</div>
</div>
</header>
<!-- //header -->
<!-- breadcrum -->
@yield('content')
<!-- footer -->
<footer class="w3l-footer-29-main" id="footer">
 <div class="footer-29 py-5">
   <div class="container pb-lg-3">
     <div class="row footer-top-29">
       <div class="col-lg-4 col-md-6 footer-list-29 footer-1 mt-md-4">
         <a class="footer-logo mb-md-3 mb-2" href="#url"><img src="{{ asset('assets/images/logo-icon.png')}}" alt="" />Skill</a>
         <p>We amplify important ideas in mathematics education to help teachers grow their practice and our profession. Lorem ipsum dolor sit
         amet consectetur adipisicing elit.</p>
       </div>
       <div class="col-lg-2 col-md-6 footer-list-29 footer-2 mt-5">
        <h6 class="footer-title-29">Explore More</h6>
        <ul>
         <li><a href="#gallery.html">Gallery</a></li>
         <li><a href="#courses.html">Courses</a></li>
         <li><a href="#landing-single.html">Landing Page</a></li>
         <li><a href="#signup.html">Apply Now</a></li>
         <li><a href="contact.html">Buy Course Online</a></li>
       </ul>
     </div>
     <div class="col-lg-4 col-md-6 footer-list-29 footer-3 mt-5">
       <div class="properties">
         <h6 class="footer-title-29">Recent Post</h6>
         <a class="d-grid twitter-feed" href="#blog-single.html">
           <img src="{{ asset('assets/images/g1.jpg')}}" class="img-fluid rounded" alt="">
           <p>How to get Programming language Cartification in 45 days.</p>
         </a>
         <a class="d-grid twitter-feed" href="#blog-single.html">
           <img src="{{ asset('assets/images/g2.jpg')}}" class="img-fluid rounded" alt="">
           <p>Top class learning from anywhere Lorem ipsum dolor sit amet.</p>
         </a>
         <a class="d-grid twitter-feed" href="#blog-single.html">
           <img src="{{ asset('assets/images/g3.jpg')}}" class="img-fluid rounded" alt="">
           <p>Improving lives through learning Lorem ipsum dolor sit amet.</p>
         </a>
       </div>
     </div>
     <div class="col-lg-2 col-md-6 footer-list-29 footer-4 mt-5">
      <h6 class="footer-title-29">Quick Links</h6>
      <ul>
       <li><a href="index.html">Home</a></li>
       <li><a href="about.html">About</a></li>
       <li><a href="services.html">Services</a></li>
       <li><a href="#blog.html"> Blog</a></li>
       <li><a href="contact.html">Contact</a></li>
     </ul>
   </div>
 </div>
</div>
</div>
<div id="footers14-block" class="py-3">
 <div class="container">
   <div class="footers14-bottom text-center">
     <div class="social">
       <a href="#facebook" class="facebook"><span class="fa fa-facebook" aria-hidden="true"></span></a>
       <a href="#google" class="google"><span class="fa fa-google-plus" aria-hidden="true"></span></a>
       <a href="#twitter" class="twitter"><span class="fa fa-twitter" aria-hidden="true"></span></a>
       <a href="#instagram" class="instagram"><span class="fa fa-instagram" aria-hidden="true"></span></a>
       <a href="#youtube" class="youtube"><span class="fa fa-youtube" aria-hidden="true"></span></a>
     </div>
     <div class="copyright mt-1">
       <p>&copy; 2020 Skill. All Rights Reserved | Design by <a href="https://w3layouts.com/">W3Layouts</a></p>
     </div>
   </div>
 </div>
</div>

<!-- move top -->
<button onclick="topFunction()" id="movetop" title="Go to top">
 <span class="fa fa-angle-up" aria-hidden="true"></span>
</button>
<script>
       // When the user scrolls down 20px from the top of the document, show the button
       window.onscroll = function () {
         scrollFunction()
       };

       function scrollFunction() {
         if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
           document.getElementById("movetop").style.display = "block";
         } else {
           document.getElementById("movetop").style.display = "none";
         }
       }

       // When the user clicks on the button, scroll to the top of the document
       function topFunction() {
         document.body.scrollTop = 0;
         document.documentElement.scrollTop = 0;
       }
     </script>
     <!-- /move top -->

   </footer>
   <!-- Footer -->

   <!-- jQuery and Bootstrap JS -->
   <script src="{{ asset('assets/js/jquery-3.3.1.min.js')}}"></script>
   <script src="{{ asset('assets/js/bootstrap.min.js')}}"></script>

   <!-- Template JavaScript -->

   <!-- stats number counter-->
   <script src="{{ asset('assets/js/jquery.waypoints.min.js')}}"></script>
   <script src="{{ asset('assets/js/jquery.countup.js')}}"></script>
   <script>
     $('.counter').countUp();
   </script>
   <!-- //stats number counter -->


   <!-- testimonials owlcarousel -->
   <script src="{{ asset('assets/js/owl.carousel.js')}}"></script>

   <!-- script for owlcarousel -->
   <script>
     $(document).ready(function () {
       $('.owl-one').owlCarousel({
         loop: true,
         margin: 0,
         nav: false,
         responsiveClass: true,
         autoplay: false,
         autoplayTimeout: 5000,
         autoplaySpeed: 1000,
         autoplayHoverPause: false,
         responsive: {
           0: {
             items: 1,
             nav: false
           },
           480: {
             items: 1,
             nav: false
           },
           667: {
             items: 1,
             nav: false
           },
           1000: {
             items: 1,
             nav: false
           }
         }
       })
     })
   </script>
   <!-- //script for owlcarousel -->
   <!-- //testimonials owlcarousel -->

   <!-- script for courses -->
   <script>
     $(document).ready(function () {
       $('.owl-two').owlCarousel({
         loop: true,
         margin: 30,
         nav: false,
         responsiveClass: true,
         autoplay: false,
         autoplayTimeout: 5000,
         autoplaySpeed: 1000,
         autoplayHoverPause: false,
         responsive: {
           0: {
             items: 1,
             nav: false
           },
           480: {
             items: 1,
             nav: false
           },
           667: {
             items: 2,
             nav: false
           },
           1000: {
             items: 3,
             nav: false
           }
         }
       })
     })
   </script>
   <!-- //script for courses -->

   <!-- disable body scroll which navbar is in active -->
   <script>
     $(function () {
       $('.navbar-toggler').click(function () {
         $('body').toggleClass('noscroll');
       })
     });
   </script>
   <!-- disable body scroll which navbar is in active -->
   @yield('scripts')

 </body>

 </html>