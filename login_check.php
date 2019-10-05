<?php
session_start();
$name=$_POST['name'];
$pass=$_POST['pass'];

$servername = "127.0.0.1";
$username = "jaeun";
$password = "1234";
$db="memberDB";

// Create connection
$conn = new mysqli($servername,$username,$password,$db);

$check="SELECT * FROM memberinfo WHERE name='$name'";
$result=$conn->query($check);
if($result->num_rows==1){
  $row=$result->fetch_array(MYSQLI_ASSOC);

  if($row['pwd']==$pass){
    $_SESSION['name']=$name;
      if(isset($_SESSION['name']))
      {
        header('Location:mainpage.php');
      }
      else{
          echo"세션저장실패";
        }
      }
      else{
        echo "<script>alert(\"wrong id or pw\");</script>";
        echo("<script>location.replace('../login/login.php');</script>");
      }
}
else{
  echo "<script>alert(\"wrong id or pw\");</script>";
  echo("<script>location.replace('../login/login.php');</script>");

}
?>
