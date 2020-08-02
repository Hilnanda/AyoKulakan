@extends('layouts.scaffold')

@section('js-filters')
d.nama = $("input[name='filter[name]']").val();
@endsection

@section('rules')
<script type="text/javascript">
  formRules = {
    judul: ['empty'],
  };
</script>
@endsection

@section('style')
<style>
/* Always set the map height explicitly to define the size of the div
* element that contains the map. */
#map {
  height: 100%;
}
/* Optional: Makes the sample page fill the window. */
html, body {
  height: 100%;
  margin: 0;
  padding: 0;
}
#description {
  font-family: Roboto;
  font-size: 15px;
  font-weight: 300;
}

#infowindow-content .title {
  font-weight: bold;
}

#infowindow-content {
  display: none;
}

#map #infowindow-content {
  display: inline;
}

.pac-card {
  margin: 10px 10px 0 0;
  border-radius: 2px 0 0 2px;
  box-sizing: border-box;
  -moz-box-sizing: border-box;
  outline: none;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
  background-color: #fff;
  font-family: Roboto;
}

#pac-container {
  padding-bottom: 12px;
  margin-right: 12px;
}

.pac-controls {
  display: inline-block;
  padding: 5px 11px;
}

.pac-controls label {
  font-family: Roboto;
  font-size: 13px;
  font-weight: 300;
}

#pac-input {
  background-color: #fff;
  font-family: Roboto;
  font-size: 15px;
  font-weight: 300;
  margin-left: 12px;
  padding: 0 11px 0 13px;
  text-overflow: ellipsis;
  width: 400px;
}

#pac-input:focus {
  border-color: #4d90fe;
}

#title {
  color: #fff;
  background-color: #4d90fe;
  font-size: 25px;
  font-weight: 500;
  padding: 6px 12px;
}
#target {
  width: 345px;
}
</style>

@endsection

@section('scripts')
<script>
    function initAutocomplete() {
      var map = new google.maps.Map(document.getElementById('map'), {
        center: {lat:-6.8836095, lng:  107.5717915},
        zoom: 18,
        mapTypeId: 'roadmap'
      });


      var input = document.getElementById('pac-input');

      var searchBox = new google.maps.places.SearchBox(input);
      map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);



      map.addListener('bounds_changed', function() {
        searchBox.setBounds(map.getBounds());
      });

      var markers = [];





      searchBox.addListener('places_changed', function() {
        var places = searchBox.getPlaces();

        if (places.length == 0) {

          return false;
        }



        markers.forEach(function(marker) {

          marker.setMap(null);
        });
        markers = [];


        var bounds = new google.maps.LatLngBounds();
        places.forEach(function(place) {

          if (!place.geometry) {
            console.log('cek')
            return;
          }
          var icon = {
            url: place.icon,
            size: new google.maps.Size(71, 71),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(25, 25)
          };


          markers.push(new google.maps.Marker({
            map: map,
            icon: icon,
            title: place.name,
            position: place.geometry.location
          }));

          if (place.geometry.viewport) {

            bounds.union(place.geometry.viewport);
          } else {
            bounds.extend(place.geometry.location);
          }
        });
        map.fitBounds(bounds);
    });

    infoWindow = new google.maps.InfoWindow;

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            console.log('pos',map,'[',position,'pos',pos)
            infoWindow.setPosition(pos);
            infoWindow.setContent('Location found.');
            infoWindow.open(map);
            map.setCenter(pos);
        //      var marker = new google.maps.Marker({
        //   position: myLatLng,
        //   map: map,
        //   title: 'Hello World!'
        // });

          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ? 'Error: The Geolocation service failed.' : 'Error: Your browser doesnt support geolocation.');
        infoWindow.open(map);
      }
$(document).ready(function(){
  initAutocomplete();
})
</script>
@endsection

@section('content-frontend')


<style>
  /* Set the size of the div element that contains the map */
  #map {
    height: 400px;  /* The height is 400 pixels */
    width: 100%;  /* The width is the width of the web page */
  }
</style>
</head>
<body>
  <main class="outer-top"></main>
  <a href="{{ url('/') }}" style="font-size:30px; color:orange !important"><i class="glyphicon glyphicon-arrow-left"></i></a>
  <input id="pac-input" class="controls form-control" type="text" placeholder="Search Box" >
  <div id="map"></div>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC01hCsQ46I133UAz8pdjjRXlZ-o5DT1pY&libraries=places&callback=initAutocomplete" async defer></script>
  @endsection
