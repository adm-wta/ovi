function getLatLng (thestreet, thecity, thestate, thezip){
	
	$.ajax({
		url:"php/api/getNearAddress.php",
		dataType: 'json',
		data: 
			{
			street:thestreet,
			city:thecity,
			state:thestate,
			zip:thezip
			},
		success: function (result) {
			
			var returneddata = JSON.stringify(result);
			var coord = $.parseJSON(returneddata);
			var lat = coord.lat;
			var lng = coord.lng;
			getMapPoints(lng, lat);
			
		},
		
	   	  });
	
	
}