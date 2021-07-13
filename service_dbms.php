<?php
$conn=mysqli_connect("localhost","root","","cybercity_hub");
date_default_timezone_set("Asia/Kolkata");
$_status=$_POST['status'];
if($_status==1)//check UID and get email
{
    $uid=$_POST['uid'];
    $result=mysqli_query($conn,"select email from users where uid='$uid'");
    if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_assoc($result))
        {
            echo $row['email'];
        }
    }
    else
    {
        echo "fail";
    }
}
elseif($_status==2)//show the user services
{
    $uid=$_POST['uid'];
    $result=mysqli_query($conn,"Select internet,cabletv,lpg,electricity from users where uid='$uid';");
    if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_assoc($result))
        {
            echo $row['internet']." ".$row['cabletv']." ".$row['lpg']." ".$row['electricity'];
        }
    }
}
elseif($_status==3)//update the user services
{
    $uid=$_POST['uid'];
    $internet=$_POST['internet'];
    $cabletv=$_POST['cabletv'];
    $lpg=$_POST['lpg'];
    $electricity=$_POST['electricity'];
    echo $result=mysqli_query($conn,"update users set internet=$internet, cabletv=$cabletv, lpg=$lpg, electricity=$electricity where uid='$uid';");
    
}
elseif($_status==4)//insert payment details
{
    $email=$_POST['email'];
    $cnum=$_POST['cnum'];
    $exp=$_POST['exp'];
    $cvv=$_POST['cvv'];
    $amount=$_POST['amount'];
    $date=date("Y-m-d H:i:s");
    $uid=$_POST['uid'];
    $result=mysqli_query($conn,"insert into transactions values('$email','$cnum','$exp',$cvv,$amount,'$date','$uid')");    
}
elseif($_status==5)//check if user can pay
{
    $uid=$_POST['uid'];
    $result=mysqli_query($conn,"select * from transactions where uid='$uid' and NOW()>=DATE_ADD(paid_on,INTERVAL 30 day);");
    if(mysqli_num_rows($result)>0){
        echo "pass";
    }
    else
    {
        $result=mysqli_query($conn,"select * from transactions where uid='$uid';");
        if(mysqli_num_rows($result)>0)
        {
            echo "fail";
        }
        else
        {
            echo "pass";
        }
    }
}
?>