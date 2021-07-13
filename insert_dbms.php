<?php
$conn=mysqli_connect("localhost","root","","cybercity_hub");
$email=$_POST['email'];
$uid=$_POST['uid'];
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$dob=$_POST['dob'];
$gender=$_POST['gender'];
$phno=$_POST['phno'];
$address=$_POST['address'];
$internet=$_POST['internet'];
$cabletv=$_POST['cabletv'];
$lpg=$_POST['lpg'];
$electricity=$_POST['electricity'];
$query="insert into users values('$email','$uid','$fname','$lname','$dob','$gender','$phno','$address',$internet,$cabletv,$lpg,$electricity);";
if(mysqli_query($conn,$query))
{
    echo "good";
}
else{
    echo "bad";
}
?>