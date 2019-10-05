<?php

// echo '입력한 title :'. $_POST['Num'].','.'입력한 contents : '.$_POST['$board_num'];
// echo '입력한 title :'. $_POST['today'].','.'입력한 name : '.$_POST['name'];

$servername = "127.0.0.1";
$username = "jaeun";
$password = "1234";
$db="memberDB";

// Create connection
$conn = new mysqli($servername,$username,$password,$db);


//$_POST 있을 때만 $bno 선언

if(isset($_POST['Num'])) {

  $board_num= $_POST['Num'];

}

	//(글 쓰기라면) 변수 선언

	if(empty($board_num)) {

	$today=$_POST['today'];

	}


$title=$_POST['title'];
$content=$_POST['content'];
$name=$_POST['name'];
// $today=$_POST['today'];

if ($title==null ||  $content==null ){
 echo "<script>alert(\"Fill the form\");</script>";
  exit();
}

if(isset($board_num)) {

$sql = 'update memberboard set board_title="' . $title . '", board_content="' . $content . '" where board_num = ' . $board_num;
if($conn->query($sql)){
  echo "<script>alert(\"수정 완료\");</script>";
 echo("<script>location.replace('Main_wallet/Main_wallet.php');</script>");
}else{
 echo '      수정 실패';
}

}


 else{

$sql = "INSERT INTO memberboard(board_title,board_content,board_writer,board_date)";
$sql = $sql."VALUES('$title','$content','$name','$today')";
 if($conn->query($sql)){
   echo "<script>alert(\"작성 완료\");</script>";
  echo("<script>location.replace('Main_wallet/Main_wallet.php');</script>");
 }else{
  echo '      작성 실패';
 }
}

// $q = "INSERT INTO Member_Board( board_title,board_content ) VALUES ('$title','$content')";
// if($conn->query($q)){
//   echo "<script>alert(\"작성 완료!\");</script>";
// }else{
//  echo '      fail to insert sql';
// }


?>
