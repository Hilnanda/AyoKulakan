function initMap() {
    navigator.geolocation.getCurrentPosition(position => {
        localCoord = position.coords;
        var customStyle = [{
            featureType: "poi",
            elementType: "labels",
            stylers: [{
                visibility: "off"
            }]
        }];

        var map = new google.maps.Map(document.getElementById('GoogleMap'), {
            zoom: 17,
            center: new google.maps.LatLng(localCoord.latitude, localCoord.longitude),
            disableDefaultUI: false,
            styles: customStyle,
        });

        var me = new google.maps.InfoWindow({
            content: 'You are Here'
        });

        var myMark = new google.maps.Marker({
            position: {
                lat: localCoord.latitude,
                lng: localCoord.longitude
            },
            map: map
        });

        myMark.addListener('click', function() {
            me.open(map, myMark);
        });

        fetch(window.apiUrl)
            .then((res) => res.json())
            .then(function(data) {
                for (var i = 0; i < data.results.length; i++) {
                    var coords = data.results[i].geometry.location;
                    var latLng = new google.maps.LatLng(coords);
                    var contentString = `<div>
                        ${data.results[i].name}
                    </div>`;

                var infowindow = new google.maps.InfoWindow({
                    content: contentString
                });

                var marker = new google.maps.Marker({
                    position: latLng,
                    map: map,
                    icon: window.mapIcon,
                    title: data.results[i].name
                });

                marker.addListener('click', function() {
                    infowindow.open(map, marker);
                });
            }
        });
    });
}
