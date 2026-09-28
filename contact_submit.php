<?php
@session_start();
 
@ob_start();
 
 
  
   
 

error_reporting(E_ALL & ~E_NOTICE);
if(isset($_POST['send']) )
{
	 

	 

 //name email  subj add msg send
	$name = trim(stripslashes($_POST['name']));
	$email = trim(stripslashes($_POST['email']));
	$phone = trim(stripslashes($_POST['phone']));
	$msg = trim(stripslashes($_POST['msg']));
	 
	 
	 
	 
	
$Body ="";
$Body .="<html>
<head>

<style type='text/css'>
.TFtable{width:100%;border-collapse:collapse;}
.TFtable td{padding:7px; border:#EAF2FA 1px solid;}
.TFtable tr{background: #EAF2FA;}
.TFtable tr:nth-child(odd){background: #EAF2FA;}
.TFtable tr:nth-child(even){background: #FFFFFF;}
</style>

</head>

<body>

<div style='background: #bad6f3; padding:7px; text-transform:uppercase; text-align:center; border:#bad6f3 1px solid;font-family:Arial, Helvetica, sans-serif;font-weight:bold;'>
	<h3>AP Legal Contact Form</h3>
</div>

<table class='TFtable' style='width:100%;border-collapse:collapse;'>";

$Body .= "<tr style='background: #EAF2FA; '>
<td style='padding:7px; width:30%; border:#bad6f3 2px solid;font-family:Arial, Helvetica, sans-serif;font-weight:bold;'>Your Name </td><td style='padding:7px; background: #fff; border:#bad6f3 2px solid;'>";
$Body .= $name;
$Body .="</td></tr>";

$Body .= "<tr style='background: #EAF2FA'>
<td style='padding:7px; width:30%; border:#bad6f3 2px solid;font-family:Arial, Helvetica, sans-serif;font-weight:bold;'>Email</td><td style='padding:7px; background: #fff; border:#bad6f3 2px solid;'>";
$Body .= $email;
$Body .= "</td></tr>";

$Body .= "<tr style='background: #EAF2FA'>
<td style='padding:7px; width:30%; border:#bad6f3 2px solid;font-family:Arial, Helvetica, sans-serif;font-weight:bold;'>Contact Number </td><td style='padding:7px; background: #fff; border:#bad6f3 2px solid;'>";
$Body .= $phone;
$Body .= "</td></tr>";

$Body .= "<tr style='background: #EAF2FA'>
<td style='padding:7px; width:30%; border:#bad6f3 2px solid;font-family:Arial, Helvetica, sans-serif;font-weight:bold;'>Message </td><td style='padding:7px; background: #fff; border:#bad6f3 2px solid;'>";
$Body .= $msg;
$Body .= "</td></tr></table></body></html>";


//echo($Body);
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= "From:$name <website_enquiry@aplegal.in>";
	$message =  $Body;	
	
	$Subject ='Enquiry From '.$email ;
//echo ($EmailTo ."|".$Subject."|". $Body."|". $headers);
 $EmailTo ='info@aplegal.in';
$success1 = @mail($EmailTo, $Subject, $message, $headers) ; 

if($success1 >0){
$_SESSION['msg'] ='Thank You For Your Enquiry! We Will Contact You Shortly!';
/*echo("<script>location.href='contact-us.php';</script>"); */
 //header("location:thank-you.php");
 echo "<meta http-equiv='Refresh' content='0; url=thank-you'>";

exit;
}
else{
	$_SESSION['msg'] ='Invalid Email Id!';
	/*echo("<script>location.href='contact-us.php';</script>"); */
	// header("location:thank-you.php");
	echo "<meta http-equiv='Refresh' content='0; url=thank-you'>";
	exit;
	}
exit;}
?>
