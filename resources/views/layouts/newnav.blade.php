<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="api-base-url" content="{{ url('/') }}">
    <meta name="user_id" content="{{ auth()->id() }}">

    <title>Driver Khoji</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/owl.theme.default.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bundles/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/iziToast.css') }}" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <!-- Font aso -->
    <script src="https://kit.fontawesome.com/a627728a7c.js" crossorigin="anonymous"></script>

    @stack('styles')
</head>

<body>
    <div class="popup" id="modal_id">
        <div class="mt-4">
            <div class="d-flex center">

                <div class="form-part mt-5" style="width: 450px">
                    <h2>{{ __('Please, Login') }}</h2>
                    {{-- <p>Sign in with your mobile number</p> --}}
                    <div class="">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <input type="hidden" name="define_previous_url" value="{{ route('nearest.workshop') }}">

                            <div class="mt-2">
                                <span class="text-warning text-start">
                                    <b>{{ \Illuminate\Support\Facades\Session::get('phone_number') }}</b>
                                </span>

                                <label for="mobile" class="form-label text-start d-block">Mobile Number</label>
                                <div class="full-name text-start">
                                    <img src="{{ asset('images/logoset/call.svg') }}" alt="">
                                    <input type="text" id="phone_number" name="phone_number" placeholder="Enter mobile number" required
                                        autofocus>
                                    @error('phone_number')
                                        <span class="text-warning fa fa-warning">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-3">
                                <label for="password"
                                    class="form-label text-start d-block">{{ __('Password') }}</label>
                                <div class="full-name">
                                    <img src="{{ asset('images/logoset/lock.png') }}" alt="">
                                    <input id="password" type="password"
                                        class=" @error('password') is-invalid @enderror" name="password" required
                                        autocomplete="current-password" placeholder="Password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- <div class="row mb-3 mt-2">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label text-start" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div> --}}

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <button type="submit" class="sign-button">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                        <div class="bottom-part">
                            <p>Don’t have an account? <a href="{{ route('register', 'nearest-workshop') }}"> Register</a></p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @include('layouts.navbar.navbar')
    <div id="app">
        <main class="mb-0" id="main">
            @yield('content')
        </main>

        @include('layouts.navbar.footer')
        @include('layouts.navbar.accessory')



    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('bundles/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/iziToast.js') }}"></script>
    <script src="{{ asset('js/custom-navbar.js') }}"></script>
    <script src="{{ asset('js/user-notification.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>

    @include('vendor.lara-izitoast.toast')


    @stack('scripts')
    <script>
        class CountUp {
            constructor(triggerEl, counterEl) {
                const counter = document.querySelector(counterEl)
                const trigger = document.querySelector(triggerEl)
                let num = 0

                const countUp = () => {
                    if (num <= counter.dataset.stop)
                        ++num
                    counter.textContent = num
                }

                const observer = new IntersectionObserver((el) => {
                    if (el[0].isIntersecting) {
                        const interval = setInterval(() => {
                            (num < counter.dataset.stop) ? countUp(): clearInterval(interval)
                        }, counter.dataset.speed)
                    }
                }, {
                    threshold: [0]
                })

                observer.observe(trigger)
            }
        }

        // Initialize any number of counters:
        new CountUp('#start1', '#counter1')
        new CountUp('#start2', '#counter2')
        new CountUp('#start3', '#counter3')
        new CountUp('#start4', '#counter4')
        new CountUp('#start5', '#counter5')
        new CountUp('#start6', '#counter6')
    </script>
    <script>
        $('.owl-three').owlCarousel({
              loop: true,
              // margin: 20,
              nav: true,
              autoplay: true,
              autoplayTimeout: 2000,
              autoplayHoverPause: true,
              responsive: {
                  0: {
                      items: 1
                  },
                  600: {
                      items: 4
                  },
                  1000: {
                      items: 7
                  }
              }
          })
          $('.slider-owl').owlCarousel({
              // loop: true,
              margin: 20,
              nav: true,
              // autoplay: true,
              // autoplayTimeout: 1000,
              // autoplayHoverPause: true,
              responsive: {
                  0: {
                      items: 1
                  },
                  600: {
                      items: 4
                  }
              }
          })

          $('.play').on('click', function() {
              owl.trigger('play.owl.autoplay', [2000])
          })
          $('.stop').on('click', function() {
              owl.trigger('stop.owl.autoplay')
          })


          // for progress bar

          const skillsSection = document.getElementById('bar-section');
          const allBars = document.querySelectorAll('.circle_percent');

          function showBar() {
              $(".circle_percent").each(function() {
                  var $this = $(this),
                      $dataV = $this.data("percent"),
                      $dataDeg = $dataV * 3.6,
                      $round = $this.find(".round_per");
                  $round.css("transform", "rotate(" + parseInt($dataDeg + 180) + "deg)");
                  $this.append('<div class="circle_inbox"><span class="percent_text"></span></div>');
                  $this.prop('Counter', 0).animate({
                      Counter: $dataV
                  }, {
                      duration: 2000,
                      easing: 'swing',
                      step: function(now) {
                          $this.find(".percent_text").text(Math.ceil(now));
                      }
                  });
                  if ($dataV >= 51) {
                      $round.css("transform", "rotate(" + 360 + "deg)");
                      setTimeout(function() {
                          $this.addClass("percent_more");
                      }, 1000);
                      setTimeout(function() {
                          $round.css("transform", "rotate(" + parseInt($dataDeg + 180) + "deg)");
                      }, 1000);
                  }
              });
          }

          window.addEventListener('scroll', () => {
              const sectionPos = skillsSection.getBoundingClientRect().top;
              const screenPos = window.innerHeight;
              if (sectionPos <= screenPos) {
                  showBar();
              }
          })

          // owl carasoul light box
          // Open the Modal
          function openModal() {
              document.getElementById("myModal").style.display = "block";
          }

          // Close the Modal
          function closeModal() {
              document.getElementById("myModal").style.display = "none";
          }

          var slideIndex = 1;
          showSlides(slideIndex);

          // Next/previous controls
          function plusSlides(n) {
              showSlides(slideIndex += n);
          }

          // Thumbnail image controls
          function currentSlide(n) {
              showSlides(slideIndex = n);
          }

          function showSlides(n) {
              var i;
              var slides = document.getElementsByClassName("mySlides");
              var dots = document.getElementsByClassName("demo");
              var captionText = document.getElementById("caption");
              if (n > slides.length) {
                  slideIndex = 1
              }
              if (n < 1) {
                  slideIndex = slides.length
              }
              for (i = 0; i < slides.length; i++) {
                  slides[i].style.display = "none";
              }
              for (i = 0; i < dots.length; i++) {
                  dots[i].className = dots[i].className.replace(" active", "");
              }
              slides[slideIndex - 1].style.display = "block";
              dots[slideIndex - 1].className += " active";
              // captionText.innerHTML = dots[slideIndex - 1].alt;
          }
  </script>
</body>

</html>
