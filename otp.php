<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
date_default_timezone_set("Asia/Kolkata");
$conn=mysqli_connect("localhost","root","","cybercity_hub");
$email=$_POST['email'];
$status=$_POST['status'];
$otp=$_POST['otp'];
//echo $email="atit1970@gmail.com";
//echo $otp=rand(11111,99999);
if($status==1)//Sending OTP to new user 
{
    require 'vendor/autoload.php';
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->SMTPSecure = 'ssl';
    $mail->SMTPAuth = true;
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 465;
    $mail->Username = 'your email';
    $mail->Password = 'your password';
    $mail->setFrom('your email');
    $mail->addAddress($email);
    $mail->Subject = "CyberCity Hub OTP";
    $mail->Body = 'Your OTP is :- '.$otp."\n The OTP is valid for 5 minutes";
    //send the message, check for errors
    if (!$mail->send()) {
        //echo "ERROR: " . $mail->ErrorInfo;
        echo "error";
    } else {
        echo "success";
        $date=date("Y-m-d H:i:s");
        $result=mysqli_query($conn,"insert into otptbl values('$email',$otp,'$date');");
    }
}
elseif($status==2)//verify otp
{
    $result=mysqli_query($conn,"select * from otptbl where otp=$otp and email='$email' and NOW()<=DATE_ADD(issued,INTERVAL 5 MINUTE);");
    if(mysqli_num_rows($result)>0){
        echo "pass";
    }
    else{
        echo "fail";
    }
}
?>
