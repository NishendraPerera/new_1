@extends('frontend.layout.main')

@section('content')

<!--================Home Banner Area =================-->
  <!-- breadcrumb start-->
  {{-- <section class="breadcrumb breadcrumb_bg">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-8">
              <div class="breadcrumb_iner">
                <div class="breadcrumb_iner_item">
                  <h2>contact us</h2>
                  <p>Home <span>-</span> contact us</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section> --}}
      <!-- breadcrumb start-->
    
      <!-- ================ contact section start ================= -->
      <section class="contact-section padding_top">
        <div class="container">

          <iframe style="width: 100%;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.7611739694926!2d79.87090181427706!3d6.919129795000651!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2597547886bff%3A0x40b66ad360d6e798!2sColombo%20Catholic%20Press!5e0!3m2!1sen!2slk!4v1580108297036!5m2!1sen!2slk" width="800" height="600" frameborder="0" style="border:0;" allowfullscreen=""></iframe>

          {{-- <div class="d-none d-sm-block mb-5 pb-4">
            <div id="map" style="height: 480px;"></div>
            <script>
              var map;
              function initMap() {
                var uluru = {
                  lat: 6.9191298,
                  lng: 79.8730905
                };
                var grayStyles = [{
                    featureType: "all",
                    stylers: [{
                        saturation: -90
                      },
                      {
                        lightness: 50
                      }
                    ]
                  },
                  {
                    elementType: 'labels.text.fill',
                    stylers: [{
                      color: '#ccdee9'
                    }]
                  }
                ];
                var map = new google.maps.Map(document.getElementById('map'), {
                  center: {
                    lat: 6.9191298,
                    lng: 79.8730905
                  },
                  zoom: 15,
                  styles: grayStyles,
                  scrollwheel: false
                });
              }
            </script>
            <script
              src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDhkn4BGHc1hwQ2oy3xHHQyJduaVZRZ-Qc&callback=initMap">
            </script>



          </div> --}}
    
    
          <div class="row">
            <div class="col-12">
              <h2 class="contact-title">Get in Touch</h2>
            </div>
            <div class="col-lg-8">
              <form class="form-contact contact_form" action="contact_process.php" method="post" id="contactForm"
                novalidate="novalidate">
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
    
                      <textarea class="form-control w-100" name="message" id="message" cols="30" rows="9"
                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Message'"
                        placeholder='Enter Message'></textarea>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <input class="form-control" name="name" id="name" type="text" onfocus="this.placeholder = ''"
                        onblur="this.placeholder = 'Enter your name'" placeholder='Enter your name'>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <input class="form-control" name="email" id="email" type="email" onfocus="this.placeholder = ''"
                        onblur="this.placeholder = 'Enter email address'" placeholder='Enter email address'>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                      <input class="form-control" name="subject" id="subject" type="text" onfocus="this.placeholder = ''"
                        onblur="this.placeholder = 'Enter Subject'" placeholder='Enter Subject'>
                    </div>
                  </div>
                </div>
                <div class="form-group mt-3">
                  <a href="#" class="btn_3 button-contactForm">Send Message</a>
                </div>
              </form>
            </div>
            <div class="col-lg-4">
              <div class="media contact-info">
                <span class="contact-info__icon"><i class="ti-home"></i></span>
                <div class="media-body">
                  <h3>Colombo Catholic Press.</h3>
                  <p>No:2,
                    Gnanarthapradeepaya Mawatha,
                    Colombo 08, Sri Lanka
                  </p>
                </div>
              </div>
              <div class="media contact-info">
                <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                <div class="media-body">
                  <h3>+94 11 2695984, +94 11 2678106 </h3>
                  <p>Mon to Fri 9am to 5pm</p>
                </div>
              </div>
              <div class="media contact-info">
                <span class="contact-info__icon"><i class="ti-email"></i></span>
                <div class="media-body">
                  <h3>info@colomboarchdiocesancatholicpress.com </h3>
                  <p>Send us your query anytime!</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- ================ contact section end ================= -->
    

@endsection