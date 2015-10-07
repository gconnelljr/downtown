$(function(){
	// gallery slider
	$(document).on("click", ".small-pic", function(){
		$('.big-pic').attr('src', $(this).attr('src'));
	});

	// ticket details drop down
	$(document).on("click", ".ticket_details a", function(){ 
		$(this).parent().next(".ticket-lists").toggle("faster");
	});

	// google maps ali
	function initialize() {
	  var mapProp = {
	    center:new google.maps.LatLng(51.508742,-0.120850),
	    zoom:5,
	    mapTypeId:google.maps.MapTypeId.ROADMAP
	  };
	  var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
	}
	google.maps.event.addDomListener(window, 'load', initialize);

});
