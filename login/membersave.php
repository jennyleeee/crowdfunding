<?php

// echo '입력한 email :'. $_POST['regname'].','.'입력한 password : '.$_POST['regpass'];


$servername = "127.0.0.1";
$username = "jaeun";
$password = "1234";
$db="memberDB";

// Create connection
$conn = new mysqli($servername,$username,$password,$db);

// Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }
// echo "Connected successfully";

 $name=$_POST['regname'];
 $pwd1=$_POST['regpass'];
 $pwd2=$_POST['reregpass'];




if($pwd1!=$pwd2){
   echo "<script>alert(\"입력한 비밀번호가 다릅니다\");</script>";
  echo("<script>location.replace('login.php');</script>");
   // echo "<a herf=login.php> back page </a>";
  exit();
}

if ($name==null ||  $pwd1==null || $pwd2==null){
 echo "<script>alert(\"Fill the form\");</script>";
  echo("<script>location.replace('login.php');</script>");
  exit();
}

$check="SELECT * from memberinfo where name='$name'";
$result=$conn->query($check);
if($result->num_rows==1){
echo "<script>alert(\"중복된 id입니다.\");</script>";
echo("<script>location.replace('login.php');</script>");
exit();
}

$sql = "insert into memberinfo(name,pwd)";
$sql = $sql. "values('$name','$pwd1')";
 if($conn->query($sql)){
   echo "<script>alert(\"회원가입 완료\");</script>";
   echo("<script>location.replace('../mainpage.php');</script>");
 }else{
  echo 'fail to insert sql';
 }


// $q = "INSERT INTO memberinfo ( name, pwd ) VALUES ( '$name', '$pwd1')";
//
//  $conn->query($q);

?>
