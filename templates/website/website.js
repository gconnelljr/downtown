$(function() {
// Button to close market dropdown
	$(document).on("click", ".drop-menu, .city_color", function(){
		console.log('hi');
		$(".featured_cities").toggle();
	});

	$(document).on("click", ".other-cities", function(){
		console.log('sup');
		$(".non-featured-cities").toggle("faster");
	});

	// ticket carousel dropdown
	$(document).on("click", ".ticket_details", function(){ 
		console.log('hi');
		// console.log($(this).parent());
		// console.log($(this).parent().next(".ticket-lists"));
		$(this).next("#ticket-drop").toggle("faster");
	});

	// carousel
	$(document).on("click", ".small-pic", function(){
		$('.big-pic').attr('src', $(this).attr('src'));
	});

});


// Saving function for newsletter signup
	$(document).on("click", "#newsletter_submit", function(e){
		e.preventDefault();
		if($("#newsletter_email").val() == ""){
			$("#newsletter_email").attr("placeholder", "Please Enter Your Email Address");
		} else {
			var url = "/aql/save/ctn_newsletter_subscriber",
			data = $("#newsletter_form").serialize();
			$("#newsletter_form").hide();
			$("#newsletter_save")
			.css("width","440px")
			.html("<img src='/templates/website/content/images/animated_loading.gif' alt='loading' title='loading'>");
			$.post(url, data, function(data){
				if(data.status == "OK"){
					$("#newsletter_save").html("Thank You For Signing Up!");
				} else {
					$("#newsletter_save").html("We Could Not Sign You Up Now");
				}
			});	
		}
	});