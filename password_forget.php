<?php

include_once("../main/class.phpmailer.php");
include_once("php/dbcontroller.php");
session_start();

function RandomString(){
	$characters = '123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$randstring = '';
	for ($i = 0; $i < 9; $i++) {
		$randstring .= $characters[rand(0, strlen($characters))];
	}
	return $randstring;
}
$errors = array();

if(isset($_POST['email']) || $_POST['email']<>''){ 
	$Email = $_POST['email'];	
	if(trim($Email)==""){
			array_push($errors, "email cannot be left blank");
	}
	
	if(trim($Email)<>""){
		/*if(!filter_var($Email, FILTER_VALIDATE_EMAIL)){
			array_push($errors, "Invalid email entered");
		}*/
		if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$Email)){
		  array_push($errors, "Invalid email entered");
		}
	}
	
	if(count($errors)==0){ 
		$RandPass = RandomString();
		$dbcontroller = new DBController();
		$sent = $dbcontroller->ForgotPassword($Email, $RandPass);
		
		if($sent){
			$subject = "Forgot Password";
		
			$messagehtml="Hi,<br/><br/>Your password has been changed.<br/><br/>Your new password is : <b>".$RandPass."</b><br/><br/>After login please change your password.<br/><br/>Please <a href='http://espconsultant.com/www/espadmin/index.php'>Click here</a> to login";
			
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: ESP Website <touchbase@espconsultant.com>' . "\r\n";
			mail($Email, $subject, $messagehtml, $headers);
			
			
			/*$mail = new PHPMailer();
			$mail->IsSMTP(); // telling the class to use SMTP
			$mail->Host       = "smtp.rediffmailpro.com"; // SMTP server
			$mail->SMTPAuth   = true;                  // enable SMTP authentication
			$mail->Host       = "smtp.rediffmailpro.com"; // sets the SMTP server
			$mail->Port       = 587;                    // set the SMTP port for the Rediff server
			$mail->Username   = "touchbase@espconsultant.com"; // SMTP account username
			$mail->Password   = "01052014";
	
			$mail->SetFrom('touchbase@espconsultant.com', 'ESP Website');
			//$mail->AddReplyTo("touchbase@espconsultant.com","ESP Website");
			$mail->Subject    = $subject;
			$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
			
			$mail->MsgHTML($messagehtml);
			
			$address = $Email;
			$mail->AddAddress($address, "ESP Website");
			if($mail->Send()){
				echo 'Priyesh';
			}else{
				echo $mail->ErrorInfo;
			}
			*/
			
			
			
			
			
			
			
			header("Location: index.php");
		}
	}
}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN">
<html>
    <head>
        <title>PHP Login System</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <link rel="stylesheet" type="text/css" href="css/style.css" />
            <script type="text/javascript" language="javascript" src="javascript/jquery-1.3.2.js"></script>
            
    </head>
    <body>
		<div id='reg'>
        <div id="main" class="login">
			<div id="pagecontent" class="forgotpw">
            <h1>Password Request</h1>
                <p>Type your email. You'll receive information on how to reset your password:</p>
                <form action="password_forget.php" method="POST" name="form_passwprocess" id="form_passwprocess">
                    <label>email</label>
                    <input class="inplaceError" type="text" id="email" name="email" maxlength="120" value="<?php echo $_POST['email'];?>"/>
                    <input type="hidden" name="forgetpasswordaction" value="1"/>
                    <div style="clear:both;"></div>
					<?php if(count($errors)>0){?>
					<div id="email_error" class="error">
						<?php foreach($errors as $val) {?>
                        <div class="errorimg"><?php echo $val;?></div>
						<?php } ?>
                    </div>
					<?php } ?>
					<a href="index.php">Back</a>
					<input type="submit" value="Send" class="button"> 
                </form>
				<img style="display:none;margin-bottom:15px;" class="ajaxload" id="ajaxld" src="images/ajax-loader.gif"/>            
            </div>
        </div>
      </div>
    </body>
</html>
