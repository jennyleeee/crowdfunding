<?php
$regname=$_POST['regname'];
$regpass=$_POST['regpass'];
$reregpass=$_POST['reregpass'];

if($regpass!=$reregpass)//pw!=againpw
{
  echo "passwords incorrect";
    exit();
}

if ($regname==null || $regpass==null || $reregpass==null){
  echo "fill the forms";
  exit();
}
$mysqli = mysqli_connect('localhost', 'jaeun', '1234', 'myService');
$check="SELECT * from account_info WHERE id = '$regname'";
$result=$mysqli->query($check);
if($result->num_rows==1){
  echo "already existed ID";
  exit();
}
 ?>
