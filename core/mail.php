<?php

require_once("../config.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php';
      
function mailUser($user_email, $verificationHash)
{
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->SMTPDebug = 0; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
    $mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
    $mail->Port = 587; // TLS only
    $mail->SMTPSecure = 'tls'; // ssl is depracated
    $mail->SMTPAuth = true;
    $mail->Username = "luciferssd11@gmail.com";
    $mail->Password = getenv("email_password");
    $mail->setFrom("luciferssd11@gmail.com", "Hotel Book");
    $mail->addAddress($user_email, "New User");
    $mail->Subject = 'PHPMailer GMail SMTP test';

    $mail->msgHTML(
        "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" lang=\"en-GB\">
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
<title>Demystifying Email Design</title>
<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\"/>

<style type=\"text/css\">
a[x-apple-data-detectors] {color: inherit !important;}
</style>

</head>
<body style=\"margin: 0; padding: 0;\">
<table role=\"presentation\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">
<tr>
<td style=\"padding: 20px 0 30px 0;\">

<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"600\" style=\"border-collapse: collapse; border: 1px solid #cccccc;\">
<tr>
<td align=\"center\" bgcolor=\"#70bbd9\" style=\"padding: 40px 0 30px 0;\">
<!-- <img src=\"https://assets.codepen.io/210284/h1_1.gif\" alt=\"Creating Email Magic.\" width=\"300\" height=\"230\" style=\"display: block;\" /> -->
<h1 style=\"color: #0b1b22; font-family: Arial, sans-serif;\">Hotel Booking</h1>
</td>
</tr>
<tr>
<td bgcolor=\"#ffffff\" style=\"padding: 40px 30px 40px 30px;\">
<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"border-collapse: collapse;\">
<tr>
<td style=\"color: #153643; font-family: Arial, sans-serif;\">
<h1 style=\"font-size: 24px; margin: 0;\">Thank you for signing up!</h1>
</td>
</tr>
<tr>
<td style=\"color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 24px; padding: 20px 0 30px 0;\">
<p style=\"margin: 0;\">Verify you account by clicking the following link.<br /> <a href=\"".SROOT."/verify_user.php?email=".$user_email."&hash=".$verificationHash."\">".SROOT."/verify_user.php?email=".$user_email."&hash=".$verificationHash."</a></p>
</td>
</tr>
<tr>
<td>
<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"border-collapse: collapse;\">
<tr>
<td width=\"260\" valign=\"top\">
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
<tr>
<td bgcolor=\"#ee4c50\" style=\"padding: 30px 30px;\">
    <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"border-collapse: collapse;\">
<tr>
<td style=\"color: #ffffff; font-family: Arial, sans-serif; font-size: 14px;\">
<p style=\"margin: 0;\">&reg; Copyright, 2020<br/>
This mail was auto generated by Hotel Booking website</p>
</td>
<td align=\"right\">
<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\">
<tr>
<td>
<a href=\"http://www.twitter.com/\">
<img src=\"https://assets.codepen.io/210284/tw.gif\" alt=\"Twitter.\" width=\"38\" height=\"38\" style=\"display: block;\" border=\"0\" />
</a>
</td>
<td style=\"font-size: 0; line-height: 0;\" width=\"20\">&nbsp;</td>
<td>
<a href=\"http://www.twitter.com/\">
<img src=\"https://assets.codepen.io/210284/fb.gif\" alt=\"Facebook.\" width=\"38\" height=\"38\" style=\"display: block;\" border=\"0\" />
</a>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>

</td>
</tr>
</table>
</body>
</html>"
    );
    $mail->AltBody = 'HTML messaging not supported';

    if (!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
}
