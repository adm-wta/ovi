function setupMap(lat, lng, result) {
    var mapCenter = new google.maps.LatLng(lat, lng); //Google map Coordinates
    var map;
    var locations = result;
    var markers;
    map_initialize(); // load map
    function map_initialize(){
        
        //Google map option
        var googleMapOptions = 
        { 
            center: mapCenter, // map center
            zoom: 12, //zoom level, 0 = earth view to higher value
            panControl: true, //enable pan Control
            zoomControl: true, //enable zoom control
            zoomControlOptions: {
            style: google.maps.ZoomControlStyle.SMALL //zoom control size
        },
            scaleControl: true, // enable scale control
            mapTypeId: google.maps.MapTypeId.ROADMAP // google map type
        };
        
        map = new google.maps.Map(document.getElementById("google_map"), googleMapOptions);     
     	//iterate through locations and drop a pin at each lat/long
    		
    	$.each(locations, function (i, val){
    		var lat = locations[i].lat;
    		var lng = locations[i].lng;
    		var point = new google.maps.LatLng(lat,lng);
    		
    		//build up an array of markers for unique positions
    		var marker = new google.maps.Marker({
    	        position: point, //map Coordinates where user right clicked
    	        map: map,
    	        draggable:true, //set marker draggable 
    	        animation: google.maps.Animation.DROP, //bounce animation
    	        icon: "http://www-test.natures-twist.com/images/greenpin.png" //custom pin icon
    	    });
    		
    		//build up an array of products for each unique location
    	  
    	
    		//Content structure of info Window for the Markers
          var contentString = $('<div class="marker-info-win">'+
        		'<div class="marker-inner-win"><span class="info-content">'+
        '<p class="marker-heading">' + locations[i].name + '</p>' +
        '<p class="marker-heading">' + locations[i].address + '</p>' +
        
        '</span>'+
        '</div></div>');
          //Create an infoWindow
            var infowindow = new google.maps.InfoWindow();
            
            //set the content of infoWindow
            infowindow.setContent(contentString[0]);
            
            //add click event listener to marker which will open infoWindow          
            google.maps.event.addListener(marker, 'click', function() {
                infowindow.open(map,marker); // click on marker opens info window 
            });
    	
    	
    	});
   }
}
