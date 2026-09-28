<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>A. P. Associates | Disclaimer</title>

<script type="text/javascript" src="http://code.jquery.com/jquery-latest.pack.js"></script>
<script>

$(document).ready(function() {	

	//select all the a tag with name equal to modal
	$('a[name=modal]').click(function(e) {
		//Cancel the link behavior
		e.preventDefault();
		
		//Get the A tag
		var id = $(this).attr('href');
	
		//Get the screen height and width
		var maskHeight = $(document).height();
		var maskWidth = $(window).width();
	
		//Set heigth and width to mask to fill up the whole screen
		$('#mask').css({'width':maskWidth,'height':maskHeight});
		
		//transition effect		
		$('#mask').fadeIn(1000);	
		$('#mask').fadeTo("slow",0.8);	
	
		//Get the window height and width
		var winH = $(window).height();
		var winW = $(window).width();
              
		//Set the popup window to center
		$(id).css('top',  winH/2-$(id).height()/2);
		$(id).css('left', winW/2-$(id).width()/2);
	
		//transition effect
		$(id).fadeIn(2000); 
	
	});
	
	//if close button is clicked
	$('.window .close').click(function (e) {
		//Cancel the link behavior
		e.preventDefault();
		
		$('#mask').hide();
		$('.window').hide();
	});		
	
	//if mask is clicked
	$('#mask').click(function () {
		$(this).hide();
		$('.window').hide();
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
<style>
body {
font-family:verdana;
font-size:15px;
}

a {color:#333; text-decoration:none}
a:hover {color:#ccc; text-decoration:none}

#mask {
  position:absolute;
  left:0;
  top:0;
  z-index:9000;
  background-color:#000;
  display:none;
}
  
#boxes .window {
  position:absolute;
  left:0;
  top:0;
  width:440px;
  height:200px;
  display:none;
  z-index:9999;
  padding:20px;
}

#boxes #dialog {
  width:600px; 
  height:500px;
  padding:10px;
  background-color:#ffffff;
}

#boxes #dialog1 {
  width:375px; 
  height:203px;
}

#dialog1 .d-header {
  background:url(images/login-header.png) no-repeat 0 0 transparent; 
  width:375px; 
  height:150px;
}

#dialog1 .d-header input {
  position:relative;
  top:60px;
  left:100px;
  border:3px solid #cccccc;
  height:22px;
  width:200px;
  font-size:15px;
  padding:5px;
  margin-top:4px;
}

#dialog1 .d-blank {
  float:left;
  background:url(images/login-blank.png) no-repeat 0 0 transparent; 
  width:267px; 
  height:53px;
}

#dialog1 .d-login {
  float:left;
  width:108px; 
  height:53px;
}

#boxes #dialog2 {
  background:url(images/notice.png) no-repeat 0 0 transparent; 
  width:326px; 
  height:229px;
  padding:50px 0 20px 25px;
}
</style>
</head>
<script language="javascript" type="text/javascript">
function winClose(){
	window.close(this);
}
</script>
<body>

<ul>
<li><a href="http://www.queness.com">Normal Link</a></li>
<li><a href="#dialog" name="modal">Simple Window Modal</a></li>
<li><a href="#dialog1" name="modal">Login Dialog Box</a></li>
<li><a href="#dialog2" name="modal">Sticky Note</a></li>
</ul>

<div style="font-size:10px;color:#ccc">Except where otherwise noted, content on this site is licensed under a Creative Commons Attribution 3.0 License.</div>

<div id="boxes">

<div id="dialog" class="window">
<p>
The materials and Links appearing on this website are solely provided for informational use only, and are in no way intended to constitute opinions of this law firm or any of its attorneys. This website is not intended to be, nor is, a source or form of publicity, advertisement or solicitation of work. This website does not in any way establish or intend to establish an attorney-client relationship, nor is it intended to be used as an invitation for such relationship. We at A.P.Legal &amp; Associates do not wish to represent anyone desiring representation based solely upon viewing this website. The contents of this website should not be construed as legal advice. The viewer should always seek advice of a competent legal counsel.<br />
<br />
Note also that sending an e-mail to our office does not create an attorney-client relationship, and none will be formed unless there is an expressed agreement between the firm and the client. Thus, we strongly advise against sending confidential or privileged information to us until you can establish such a relationship. Furthermore, we advise against sending privileged or confidential information through e-mail at all, since we can in no way ensure the security of your e-mail. <br />
<br />
The viewer acknowledges that there has been no inducement, invitation or solicitation of any nature whatsoever from A.P.Legal &amp; Associates or any of its members to create an attorney-client relationship through this website</p> 
<a href="#"class="close"/><input type="button" name="qsrbtn" value="Accept" onclick="this.close();" /><input type="button" name="qsrbtn" value="Decline" onclick="winClose();" /></a>
</div>
  
<!-- Start of Login Dialog -->  
<div id="dialog1" class="window">
  <div class="d-header">
    <input type="text" value="username" onclick="this.value=''"/><br/>
    <input type="password" value="Password" onclick="this.value=''"/>    
  </div>
  <div class="d-blank"></div>
  <div class="d-login"><input type="image" alt="Login" title="Login" src="images/login-button.png"/></div>
</div>
<!-- End of Login Dialog -->  



<!-- Start of Sticky Note -->
<div id="dialog2" class="window">
  So, with this <b>Simple Jquery Modal Window</b>, it can be in any shapes you want! Simple and Easy to modify : ) <br/><br/>
<input type="button" value="Close it" class="close"/>
</div>
<!-- End of Sticky Note -->



<!-- Mask to cover the whole screen -->
  <div id="mask"></div>
</div>



</body>
</html>
