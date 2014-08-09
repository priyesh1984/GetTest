<?php
require_once('class.phpmailer.php');
 
class Mailer
{

	public function __construct(){
	}
	
	
	public function sendForReg($email, $hash, $flname){
		$encoded_email = urlencode($email);
		/*$from = "From: ".EMAIL_FROM_NAME." <".EMAIL_FROM_ADDR.">";
		$subject = "Registration in codrops/loginsystem";
		$body = "Hi ".$flname."\n"
			 ."You have sucessfully registered with ESP Consultancy."
             .".........\n\n"
             ."Click on this link to activate your account:\n\nhttp://localhost/espfinal_demo/www/espadmin/php/confirm.php?hash=$hash&email=$encoded_email";

		return mail($email,$subject,$body,$from);*/
		
		$subject = "Confirn your Registration";
		
		$messagehtml="Hi ".$flname."<br/><br/>You have sucessfully registered with ESP Consultancy.<br/><br/>Click on below link to activate your account:<br/><br/><a href='http://espconsultant.com/espadmin/php/confirm.php?hash=$hash&email=$encoded_email'>http://espconsultant.com/espadmin/php/confirm.php?hash=$hash&email=$encoded_email</a>";
			 
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: ESP Website <touchbase@espconsultant.com>' . "\r\n";
		return mail($email, $subject, $messagehtml, $headers);	 		
			 
		/*$mail = new PHPMailer();
		$mail->IsSMTP(); // telling the class to use SMTP
		$mail->Host       = "smtp.rediffmailpro.com"; // SMTP server
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		$mail->Host       = "smtp.rediffmailpro.com"; // sets the SMTP server
		$mail->Port       = 587;                    // set the SMTP port for the Rediff server
		$mail->Username   = "touchbase@espconsultant.com"; // SMTP account username
		$mail->Password   = "tb@2013";

		$mail->SetFrom('touchbase@espconsultant.com', 'ESP Website');
		$mail->AddReplyTo("touchbase@espconsultant.com","ESP Website");
		$mail->Subject    = $subject;
		$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
		
		$mail->MsgHTML($messagehtml);
		
		$address = $email;
		$mail->AddAddress($address, "ESP Website");
		return $mail->Send();*/
		
	}
	
	public function sendMail($emailtosend,$message_subject,$message_body,$headers){
		return mail($emailtosend,$message_subject,$message_body,$headers);
	}
   
};
?>
