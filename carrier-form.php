<?php 



$msg = "";
//if uploaded button is pressed
if (isset($_POST['upload']))
{
	//the path to store the uploaded image
	$target = "upload/".basename($_FILES['attachement']['name']); 
	
	
	
	//get all the submitted data from the form
	$attachement = $_FILES['attachement']['name'];

	


	
	//moving the image into the folder 
	if (move_uploaded_file($_FILES['attachement']['tmp_name'], $target))
	{
		$msg = "file uploaded successfully";
		 echo "$msg";
		 
	
	
	// working email section	 
		 
		
	$filename = $attachement;
    $path = 'upload';
    $file = $path . "/" . $filename;

    $mailto = 'roy@reynold.co';
    $subject = 'Subject';
    $message = 'My message';

    $content = file_get_contents($file);
    $content = chunk_split(base64_encode($content));

    // a random hash will be necessary to send mixed content
    $separator = md5(time());

    // carriage return type (RFC)
    $eol = "\r\n";

    // main header (multipart mandatory)
    $headers = "From: name <roy@reynold.co>" . $eol;
    $headers .= "MIME-Version: 1.0" . $eol;
    $headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol;
    $headers .= "Content-Transfer-Encoding: 7bit" . $eol;
    $headers .= "This is a MIME encoded message." . $eol;

    // message
    $body = "--" . $separator . $eol;
    $body .= "Content-Type: text/plain; charset=\"iso-8859-1\"" . $eol;
    $body .= "Content-Transfer-Encoding: 8bit" . $eol;
    $body .= $message . $eol;

    // attachment
    $body .= "--" . $separator . $eol;
    $body .= "Content-Type: application/octet-stream; name=\"" . $filename . "\"" . $eol;
    $body .= "Content-Transfer-Encoding: base64" . $eol;
    $body .= "Content-Disposition: attachment" . $eol;
    $body .= $content . $eol;
    $body .= "--" . $separator . "--";

    //SEND Mail
    if (mail($mailto, $subject, $body, $headers)) {
        echo "mail send ... OK"; // or use booleans here
    } else {
        echo "mail send ... ERROR!";
        print_r( error_get_last() );
    }	 
		 
	}
	else 
	{
		$msg = "There was a problem uploading file";
			 echo "$msg";
	}
}


?>

    <!doctype html>
   <html>
<body>
<form method="post" action="carrier-form.php" enctype="multipart/form-data">
<input type="file" name="attachement" />
<input type="submit" name="upload"  />
</form>
</body>
</html>