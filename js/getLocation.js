function getLocation() {
 
//If HTML5 Geolocation Is Supported In This Browser
if (navigator.geolocation) {
 
     //Use HTML5 Geolocation API To Get Current Position
     navigator.geolocation.getCurrentPosition(function(position){
 
     //Get Latitude/Longitude From Geolocation API
     var latitude = position.coords.latitude;
 	 var longitude = position.coords.longitude;
 
   	$.ajax({
	url:"php/api/mapPointFetcher.php",
	dataType: 'json',
	data: 
		{
		lng:longitude,
		lat:latitude
		},
	success: function (result) {
		
		var returneddata = JSON.stringify(result);
		setupMap(latitude, longitude, result);
		
		},
	error: function() {
		
		alert("An error occured while receviving location data");
		
	}
   	  });
 });
}
else {
 
     //Otherwise - Gracefully Fall Back If Not Supported... Probably Best Not To Use A JS Alert Though :)
     alert("Geolocation API is not supported in your browser.");
}
 
}
