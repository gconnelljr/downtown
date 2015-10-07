$(function(){
	// gallery slider
	// $(document).on("click", ".small-pic", function(){
	// 	$('.big-pic').attr('src', $(this).attr('src'));
	// });

	$(document).on("click", "#custom_lightbox", function(){
		$(this).remove();
	});

	// pop out slider image
	$(document).on("click", ".small-pic", function(){
		//make image box appear
		var lightbox = document.createElement("div"),
		image_div = document.createElement("div"),
		image = document.createElement("img");

		lightbox.id = "custom_lightbox";
		lightbox.style.position = "fixed";
		lightbox.style.top = "0";
		//lightbox.style.top = "0";
		lightbox.style.width = "100%";
		lightbox.style.height = "100%";
		lightbox.style.background = "rgba(51, 51, 51, 0.5)";
		lightbox.style.zIndex = "100";


		image_div.style.position = "relative";
		image_div.style.marginTop = "0";
		image_div.style.marginBottom = "0";
		image_div.style.marginLeft = "auto";
		image_div.style.marginRight = "auto";
		// image_div.style.height = "50%";
		image_div.style.width = "400px";
		image_div.style.zIndex = "101";
		image_div.style.marginTop = (window.innerHeight /4) + "px";

		image.src = $(this).attr("src");

		console.log(image);

		image_div.appendChild(image); console.log(image_div);
		lightbox.appendChild(image_div); console.log(lightbox);
		document.getElementsByTagName("body")[0].appendChild(lightbox);

		//assign this image src to image box
		// $('.big-pic').attr('src', $(this).attr('src'));
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
