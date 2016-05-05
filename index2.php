<?php 

 ?>

 <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
  <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.css" />
  <link rel="stylesheet" href="css/main.css">
</head>
<body>
   <div id="mapid" style="height: 400px;"></div>
	 <script src="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js"></script>
     <script src="jquery-1.12.2.min.js"></script>
    
    <script>
    $(function() {
        $('.button').click(function() {
          showObjectsFrom1();
       });
    });
var mymap = L.map('mapid').setView([51.505, -0.09], 13);

 

		L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpandmbXliNDBjZWd2M2x6bDk3c2ZtOTkifQ._QA7i5Mpkd_m30IGElHziw', {
			maxZoom: 18,
			attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
				'<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
				'Imagery © <a href="http://mapbox.com">Mapbox</a>',
			id: 'mapbox.streets'
		}).addTo(mymap);


/*
		L.marker([51.5, -0.09]).addTo(mymap)
			.bindPopup("<b>Hello world!</b><br />I am a popup.").openPopup();
*/
		L.circle([51.508, -0.11], 500, {
			color: 'red',
			fillColor: '#f03',
			fillOpacity: 0.5
		}).addTo(mymap).bindPopup("I am a circle.");

		L.polygon([
			[51.509, -0.08],
			[51.503, -0.06],
			[51.51, -0.047]
		]).addTo(mymap).bindPopup("I am a polygon.");


		var popup = L.popup();

		function onMapClick(e) {
			popup
				.setLatLng(e.latlng)
				.setContent("You clicked the map at " + e.latlng.toString())
				.openOn(mymap);
		}

		mymap.on('click', onMapClick);


       function showObjectsFrom1() {
         $.ajax({
            url:      'js-layer1.json',
            datatype: 'json',
            type:     'get',
            cache:    false,
            success: function(data) {
              $(data.features).each(function() {
                var coordinates = this.geometry.coordinates;
                var name = this.properties.name;


                L.marker([coordinates[0], coordinates[1]]).addTo(mymap)
                                       .bindPopup(name)
                                       .openPopup(name)
                                       ;
              });
            }

        });        
       }

     


    </script>

    <button class="button">
      кнопккаа
    </button>
</body>
</html>