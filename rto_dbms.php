<?php
date_default_timezone_set("Asia/Kolkata");
error_reporting(0);
$conn=mysqli_connect("localhost","root","","cybercity_hub");
$name="";
$dob="";
$email="";
$date="";
$llnum="";
$dlnum="";
$status="";
$name=$_POST['name'];
$dob=$_POST['dob'];
$email=$_POST['email'];
$date=date("Y-m-d H:i:s");
$llnum=$_POST['llnum'];
$dlnum=$_POST['dlnum'];
$status=$_POST['status'];
if($status==1)
{
    $result=mysqli_query($conn,"insert into learners_license values('$name','$dob','$email','$date','$llnum');");
}
elseif($status==2)
{
    $result=mysqli_query($conn,"insert into drivers_license values('$email','$llnum','$dlnum');");
}
elseif($status==3)
{
    $result=mysqli_query($conn,"select * from learners_license where learners_no='$llnum' and NOW()>=DATE_ADD(issued,INTERVAL 30 day);");
    if(mysqli_num_rows($result)>0){
        echo "pass";
    }
    else{
        echo "fail";
    }
}
elseif($status==4)
{
    $result=mysqli_query($conn,"select * from learners_license where learners_no='$llnum';");
    if(mysqli_num_rows($result)>0){
        echo "pass";
    }
    else
    {
        echo "fail";
    }
}
?>