<?php
$servername = "192.168.118.148";
$username = "jaeun";
$password = "1234";


// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

 $name=$_POST['name'];
 $email=$_POST['email'];
 $pwd1=md5($_POST['pw1']);
 $pwd2=$_POST['pw2'];


if($pwd1!=$pwd2){
  echo "입력한 비밀번호가 다릅니다";
  echo "<a herf=login_rg.php> back page </a>";
  exit();
}

if ($name==null || $email==null || $pwd1==null || $pwd2==null){
  echo "fill the forms";
  exit();
}


$check="SELECT * from memberinfo WHERE id = '$email'";
$result=$mysqli->query($check);
if($result->num_rows==1){
  echo "already existed ID";
  exit();
}
$signup=mysqli_query($mysqli,"INSERT INTO memberinfo(name,id,pwd) VALUES ('$name'.'$email','$pwd1')");

if($signup) {
  echo "sign up success";
}
?>
