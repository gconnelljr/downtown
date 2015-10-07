
<section class="single-content">
<section class="events-notfound">	
<div class="noevent-head">
	<h2><?= $market->name ?></h2>
	
	<span>
		Can you believe theres no party here yet? We can’t either. We want to keep you informed when one pops up though, so please
		complete the form, and we  will let you know as soon as we can. Cheers!
	 	<?php /* email notifyme@joonbug.com and we will let you know as soon as we do. Cheers! */ ?>
	</span>
</div>	
	
	
	<form method="post" class="frmNotify" data-replace-id="notify-submitted">
		<input type="hidden" name="market_ide" value="<?= $market->ide ?>" />
			<article>
		<span>
			Please enter your contact information below. (Fields marked with a <span class="red">*</span> are required.)
		</span>
	
	<div>
		<label>First Name <span class="red">*</span></label>
		<label class="lnname">Last Name <span class="red">*</span></label>
	</div>		
			
	<div>		
		<input type="text" name="fname" required="required">
		<span class="ne-lastname specialspan"><input type="text" name="lname" required="required" /></span>
	</div>	
		
	<div class="noevent-email">	
		<label>Email Address <span class="red">*</span></label> <br />
		<input type="email" name="email" required="required" />
	</div>	
		
	<div class="ne-phone">	
		<label>Phone Number (optional)</label>
		<span><input type="phone" name="phone"  required="required" /></span>
		<br />
		

	</div>	
		
		<button type="button"  class="formbtn post_party">Please Notify Me!</button>
	
	</article>
	</form>
	
	<div style="display:none;" id="notify-submitted">Thank you, we will let you know as soon as possible.</div>
<div class="formborder"></div>
	

	<?php /* 
	<article class="usersignin">
		<span>
			Already a member? Sign in below to be notified of parties in this city.
		</span>
		
	<div>
		<label>Username <span class="red">*</span></label>
		<input type="text">
	</div>	
	
	<div>
		<label>Password <span class="red">*</span></label>
		<input type="text">
	</div>
	
	
	<a href="" class="formbtn">Submit</a>
	
	</article>
	*/ 
	?>
</section>

<div class="ne-rightform">
	<a href="http://cravetickets.com/sell-tickets/get-started?ref=newyears.com"><img class="ftimg" src="<?= $this->template_url ?>content/images/postyourpartyflyer.png" alt="Post Your Party - New Years Flyer"	/></a>
	
	<div class="formborder"></div>
	<h4>Venue & Party Organizers</h4>
	<p>Are you ready to post your party? IF you need help, call our friendly Account Service Representative who are standing by to anwser your question
</p>
</div>

</section>

<script>
      $('.formbtn').click(function() {
        var $values = $('form').serialize();
        $.post("/ajax/notifyme", $values).done(function(data) {

        if(data.status=='OK'){
        	$('#notify-submitted').show();
        	$('.frmNotify').hide();
        }
       });
    });
</script>


<style>
aside.side_content {
  display: none!important;
}

section.events-notfound {
  width: 67%;
  display: inline-block;
}

.main_content {
    width: 100%!important;
}

.noevent-head {
  margin-top: -20px;
}

img.ftimg {
  width: 100%;
}

.listings_page p{
	height: inherit;
}

.ne-rightform {
  /* display: none; */
  width: 30%;
  float: right;
  display: inline-block;
  vertical-align: top;
}

</style>