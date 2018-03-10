<html>
<head>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyAL2g7c4rz1EaTnogSGX5-UaCGBSNFE42I"></script>
</head>
<body onload="get()">

<div id="map" style="width: 400px; height: 300px;"></div>
<div id="duration">Duration:</div>
<div id="distance">Distance:</div>

</body>

<script>
var c;
function get(){
	var url_string = window.location.href; //window.location.href
var url = new URL(url_string);
c = url.searchParams.get("dist");
alert(c);
start()
}

var address;
var geocoder = new google.maps.Geocoder();

var end,latlng;
var lat,longt,newlat,newlong;
var longlat;
var char1=",";
var joint;
function start(){
codeAddress1();
//ge();
//codeAddress();
}
function codeAddress1() {
    //address = document.getElementById("my-address").value;
	address=c;
	alert(address);
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == 'OK') {
	 lat=results[0].geometry.location.lat();
	 longt=results[0].geometry.location.lng();
     // alert("Latitude: "+lat);
     // alert("Longitude: "+longt);
	   newlat=lat+0.0000011;
	   newlong=longt+0.00000000000011;
	  newlat=newlat.toString();
	  newlong=newlong.toString();
	  joint=newlat.concat(char1);
	  joint=joint.concat(newlong);
	  //alert("New lat"+newlat);
	  //alert("New long"+newlong);
	  alert(joint);
var latlngStr = joint.split(',', 2);
				alert("latlng="+latlngStr);
				 latlng = {lat: parseFloat(latlngStr[0]), lng: parseFloat(latlngStr[1])};		 
		        

				//alert(latlng.lat);
      //ge();
	  codeAddress();
	  //ge();
	  //codeAddress();
	  } 

      else {
        alert("Geocode was not successful for the following reason: " + status);
      }
    });
  }
  function ge(){
  alert("asd");
  geocoder.geocode({'location': latlng}, function(results, status) {
	alert("came!");
          if (status === 'OK') {
            if (results[0]) {
              //alert(results[0].formatted_address);
			  end=results[0].formatted_address;
			  alert("end="+end);
            } 
          } 
        });	
  
  }
function codeAddress(){

alert("fuck"+joint);
//var fuck=document.getElementById("my-address").value;
//alert(fuck);
alert(end);
var directionsService = new google.maps.DirectionsService();
var directionsDisplay = new google.maps.DirectionsRenderer();

var myOptions = {
    zoom: 7,
    mapTypeId: google.maps.MapTypeId.ROADMAP
}

var map = new google.maps.Map(document.getElementById("map"), myOptions);
directionsDisplay.setMap(map);

var request = {
    origin: address,
    destination: 'Gandhipuram',
    travelMode: google.maps.DirectionsTravelMode.DRIVING
};

directionsService.route(request, function (response, status) {
    if (status == google.maps.DirectionsStatus.OK) {

        // Display the distance:
        document.getElementById('distance').innerHTML += response.routes[0].legs[0].distance.value + " meters";

        // Display the duration:
        document.getElementById('duration').innerHTML += response.routes[0].legs[0].duration.value + " seconds";

        directionsDisplay.setDirections(response);
    }
});
}
</script>