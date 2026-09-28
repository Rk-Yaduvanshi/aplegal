<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>A. P. Associates | Contact Us</title>
<script type="text/javascript" src="../../../../www.micekdesign.com/temp/law/code/jquery-1.2.3.min.php"></script>
	<script type="text/javascript" src="../../../../www.micekdesign.com/temp/law/code/jquery.form.php"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#myForm').ajaxForm(function(data) {
				if (data==1){
					$('#success').fadeIn("slow");
					$('#myForm').resetForm();
				}
				else if (data==2){
					$('#badserver').fadeIn("slow");
				}
				else if (data==3)
				{
					$('#bademail').fadeIn("slow");
				}
			});
		});
	</script>
<link rel="stylesheet" href="css/reset.css" type="text/css" />
<link rel="stylesheet" href="css/960.css" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/prettyPhoto.css" rel="stylesheet" type="text/css" />
<link href="css/inner.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
	 Cufon.replace('h1') ('h1 a') ('h2') ('h3') ('h4') ('h5') ('h6') ('#top-navigation ul#topnav > li > a', {hover:true}) ('.datebox') ('.header-right p');
</script>
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery.cycle.all.min.js"></script>
<script type="text/javascript" src="js/quickcontact.js"></script>
<script type="text/javascript">
var $ = jQuery.noConflict();

	$(document).ready(function(){
	/* homepage slideshow */
	$('#slider').cycle({
	timeout: 8000,  // milliseconds between slide transitions (0 to disable auto advance)
	fx:      'fade', // choose your transition type, ex: fade, scrollUp, shuffle, etc...            
	pager:   '#pager',  // selector for element to use as pager container
	next:   '#next-slider',  // selector for element to use as click trigger for next slide
    prev:  '#prev-slider',  // selector for element to use as click trigger for previous slide
	pause:   0,	  // true to enable "pause on hover"
	cleartypeNoBg:   true, // set to true to disable extra cleartype fixing (leave false to force background color setting on slides)
	pauseOnPagerHover: 0 // true to pause when hovering over pager link
	});
	
});

</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-92994282-21', 'auto');
  ga('send', 'pageview');

</script>
<script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
<div class="container">
<div class="shadow">

<div class="container_12">
		<div class="grid_4 logo">
    <a href="index.php"><img  src="images/logo.jpg" alt="Your company name &amp; tagline"/></a></div>
    <div style="float:right; margin-right:25px; margin-top:15px;"><img  src="images/customer.png" width="200" height="78"/></div>
      <div class="double-line1 margin-top margin-bottom"></div>
      <div class="grid_112 nav"> 
                  <ul class="grid_18 navigation">
           
                  <li><a href="home.php">Home</a></li>
                  <li><a href="aboutus.php">About Us</a></li>
                  <li><a href="partnesr-&-associates.php">Partners & Associates</a></li>
                  <li><a href="areaofspecialization.php">Area of Specialization</a></li>
                   <li><a href="legal-outsourcing.php">Legal Outsourcing</a></li>
                     <li><a href="career.php">Careers</a></li>
                     <li><a href="sitemap.php">Sitemap</a></li>
                  <li class="active"><a href="contact.php">Contact Us</a></li>
            </ul>
    </div>
           
			
      <div class="double-line1 margin-top margin-bottom"></div>
       <div class="grid_12">
        <div class="grid_8 alpha">
          <div class="grid_12">
   
     <div class="grid_6 alpha border-right">
            <div class="contact-form">
            	<div class="padding">
                  <h1>Contact Us by Email</h1>
                  <form id="contact-form" name="contact-form" method="POST">
                            <!-- Anti-spam hidden fields -->
                            <input type="hidden" name="form_timestamp" value="<?php echo time(); ?>">
                            <div style="position: absolute; left: -5000px; opacity: 0;">
                                <label for="website">Leave this field empty</label>
                                <input type="text" name="website" id="website" tabindex="-1" autocomplete="off">
                            </div>

                            <span class="textname">Name:*</span><br />
                            <input type="text" class="text" id="name" name="name"><br />
                            <span class="error_field" id="name_error"></span>

                            <span class="textname">Email:*</span><br />
                            <input type="text" class="text" id="email" name="email" title="abc@gmail.com">
                            <br />
                            <span class="error_field" id="email_error"></span>
                            <span class="textname">Mobile:*</span><br />
                            <input type="text" class="text" name="phone" onKeyPress="return num(event)" id="phone" value="" min="1" max="10" title="Minimum 10 No" maxlength="10">
                            <span class="error_field" id="phone_error"></span>
                            <span class="textname">Message:</span><br />
                            <textarea id="msg" name="msg"></textarea>
                            <span class="error_field" id="msg_error"></span>
                            <input class="submit" type="submit" id="send" name="send" />
                        </form>
				 <div id="id1"></div>
<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.getElementById("contact-form");
        const submitBtn = document.getElementById("send");

        form.addEventListener("submit", function(event) {
            event.preventDefault();
            submitBtn.disabled = true;
            submitBtn.value = "Sending...";
            
            document.querySelectorAll('.error_field').forEach(function(el) {
                el.textContent = '';
            });

            var formData = new FormData(form);
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "enq-contact", true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    try {
                        var response = JSON.parse(xhr.responseText);
                        if (response.error) {
                            for (var key in response.error) {
                                if (response.error.hasOwnProperty(key)) {
                                    var errorEl = document.getElementById(key);
                                    if (errorEl) errorEl.innerHTML = response.error[key];
                                }
                            }
                            submitBtn.disabled = false;
                            submitBtn.value = "Submit";
                        } else if (response.success) {
                            window.location.href = "thank-you";
                        }
                    } catch (e) {
                        console.error('Error parsing response:', e);
                        alert('An error occurred. Please try again.');
                        submitBtn.disabled = false;
                        submitBtn.value = "Submit";
                    }
                } else {
                    alert('An error occurred. Please try again.');
                    submitBtn.disabled = false;
                    submitBtn.value = "Submit";
                }
            };
            xhr.onerror = function() {
                alert('An error occurred. Please try again.');
                submitBtn.disabled = false;
                submitBtn.value = "Submit";
            };
            xhr.send(formData);
        });
    });
</script>
           	  </div>
            </div>
          
         
      </div>
      <div class="grid_6 omega">
            <div class="padding no-padding-top">
            <h2>Email Id</h2>
            <p><a href="mailto:info@aplegal.in">info@aplegal.in</a></p>
            
             <h2>HEAD OFFICE</h2>
             <p>B-53, Pravasi Industrial Estate, <br />
               Vishweshwar Nagar Road, <br />
              Goregaon (E), Mumbai-63.</p>
              
              <h2>ASSOCIATE OFFICE</h2>
             <p>305/306, Vardhman Chambers <br />
3rd, Floor, Cawasji Patel Street, <br />
Fort, Mumbai- 400001.</p>

<h2>BRANCH OFFICE</h2>
             <p>1, Madhu Villa, Eksar Road, <br />
Shanti Ashram, Borivali (W),<br />
Mumbai-103</p>
</div>
            
      </div>
      </div>
      
        <div class="double-line margin-bottom"></div>
         <div class="grid_12">
           <p class="footer"> <a href="home.php">Home</a>&nbsp;&nbsp;|  
             &nbsp;&nbsp;<a href="aboutus.php">About Us</a>&nbsp;&nbsp; |  
             &nbsp;&nbsp;<a href="partnesr-&amp;-associates.php">Partners &amp; Associates</a>&nbsp;&nbsp; |  
             &nbsp;&nbsp;<a href="areaofspecialization.php">Area of Specialization</a>&nbsp;&nbsp; |  
             &nbsp;&nbsp;<a href="legal-outsourcing.php">Legal Outsourcing</a>&nbsp;&nbsp; |  
             &nbsp;&nbsp;<a href="career.php">Careers</a>&nbsp;&nbsp; |  
             &nbsp;&nbsp;<a href="sitemap.php">Sitemap</a>&nbsp;&nbsp; |  
             &nbsp;&nbsp;<a href="contact.php">Contact Us</a> <br/>
             &copy; 2010 A. P. Legal &amp; Associates | Design &amp; Maintain By <a href="https://www.eskonwebsolutions.com/" target="blank">Eskon Web Solutions</a></p>
    </div>
      </div>

</div>
</div>
</div>
</div>
</body>

<!-- Mirrored from micekdesign.com/temp/law/code/contact.php by HTTrack Website Copier/3.x [XR&CO'2010], Tue, 18 Jan 2011 12:50:43 GMT -->
</html>
