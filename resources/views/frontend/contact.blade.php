@extends('frontend.layout.main')

@section('content')

<div class="wrapper row3">
  <main class="hoc container clear"> 
    <!-- main body -->
    <!-- ################################################################################################ -->
    <div class="content"> 


      <div class="group btmspace-50 demo" >
        <div class="three_quarter first">
          <div id="googleMap" style="width: 100%; height: 375px; border-radius: 10px;"></div>
        </div>
        <div class="one_quarter" id="footer">
          <ul class="nospace linklist contact">
            <li><i class="fas fa-map-marker-alt"></i>
              <address>
              Street Name &amp; Number, Town, Postcode/Zip
              </address>
            </li>
            <li><i class="fas fa-phone"></i> +00 (123) 456 7890</li>
            <li><i class="fas fa-fax"></i> +00 (123) 456 7890</li>
            <li><i class="far fa-envelope"></i> info@domain.com</li>
          </ul>
        </div>

      </div>
    </div>
    <!-- ################################################################################################ -->
    <!-- / main body -->
    <div class="clear"></div>
  </main>
</div>

<div class="wrapper row3">
  <main class="hoc container clear"> 
    <!-- main body -->
    <!-- ################################################################################################ -->
    <div class="content"> 

      <div id="comments">
        <h2>Submit an Enquiry</h2>
        <form action="#" method="post">
          <div class="one_third first">
            <label for="name">Name <span>*</span></label>
            <input type="text" name="name" id="name" value="" size="22" required>
          </div>
          <div class="one_third">
            <label for="email">Email <span>*</span></label>
            <input type="email" name="email" id="email" value="" size="22" required>
          </div>
          <div class="one_third">
            <label for="url">Subject</label>
            <input type="text" name="subject" id="subject" value="" size="22">
          </div>
          <div class="block clear">
            <label for="comment">Your Message</label>
            <textarea name="message" id="message" cols="25" rows="10"></textarea>
          </div>
          <div>
            <input type="submit" name="submit" value="Submit">
            &nbsp;
            <input type="reset" name="reset" value="Reset Form">
          </div>
        </form>
      </div>
      <!-- ################################################################################################ -->
    </div>
    <!-- ################################################################################################ -->
    <!-- / main body -->
    <div class="clear"></div>
  </main>
</div>

<script>
  function myMap() {

    const myLatLng = { lat: 6.9191673954196915, lng: 79.87318050701118 };

    const map = new google.maps.Map(
      document.getElementById("googleMap"),
      {
        zoom: 16,
        center: myLatLng,
      }
    );

    const contentString = "<h2>Colombo Catholic Press</h2> No. 2, Gnanartha Pradeepa Mawatha, Colombo 08, Sri Lanka";

    const infowindow = new google.maps.InfoWindow({
      content: contentString,
    });

    const marker = new google.maps.Marker({
      position: myLatLng,
      map,
      title: "Colombo Catholic Press",
    });
    marker.addListener("click", () => {
      infowindow.open(map, marker);
    });


    }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDhkn4BGHc1hwQ2oy3xHHQyJduaVZRZ-Qc&callback=myMap"></script>


@endsection