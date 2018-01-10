<?php
if(isset($_POST['submit']))
{
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
$subject = $_POST['subject'];
    
$to = 'info@elephanttreetech.com';
$subject = "Re:".$subject;
$message = "Name ".$name;
$headers = "From:".$email;

if(mail($to,$subject,$message, $headers)){
	echo '<script type="text/javascript">alert("Message has been sent successfully");</script>';
	header("Location:http://www.elephanttreetech.com/#contact/");
}
else{
    echo '<script type="text/javascript">alert("Something went wrong");</script>';
	header("Location:http://www.elephanttreetech.com/#contact/");
}

}
else
{
   echo '<script type="text/javascript">alert("Problem with server");</script>'; 
   header("Location:http://www.elephanttreetech.com/#contact/");
}
?> 