<?php

include "connection.php";

$email=$_POST["e"];
$newpw=$_POST["n"];
$retypepw=$_POST["r"];
$vcode=$_POST["v"];

if(empty($email)){
    echo("Please Enter Your Email Address");
}else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    echo("Invalid Email Address");
}else if(empty($newpw)){
    echo("Please Enter New Password");
}else if(strlen($newpw)<5 || strlen($newpw)>20){
    echo("Password Must Contain 5 to 20 Characters");
}else if(empty($retypepw)){
    echo("Please Retype Password");
}else if(empty($vcode)){
    echo("Please Enter Verification Code");
}else if($newpw!=$retypepw){
    echo("Password does not match");
}else{
    $rs=Database::search("SELECT * FROM `user` WHERE `email`='".$email."' AND `verification_code`='".$vcode."'");
    $num=$rs->num_rows;

    if($num==1){
        Database::iud("UPDATE `user` SET `password`='".$retypepw."' WHERE `email`='".$email."'");
        echo("Success");
    }else{
        echo("Invalid Email Address or Verification Code");
    }
}

?>