<?php

// echo '입력한 title :'. $_POST['Num'].','.'입력한 contents : '.$_POST['$board_num'];
// echo '입력한 title :'. $_POST['today'].','.'입력한 name : '.$_POST['name'];

$servername = "127.0.0.1";
$username = "jaeun";
$password = "1234";
$db="memberDB";

// Create connection
$conn = new mysqli($servername,$username,$password,$db);


//$_GET['bno']이 있어야만 글삭제가 가능함.

	if(isset($_GET['Num'])) {
		$board_num = $_GET['Num'];
	}


if(isset($board_num)){
    $sql = 'delete from memberboard where board_num = ' . $board_num;
    if($conn->query($sql)){
      echo "<script>alert(\"정상적으로 글이 삭제되었습니다.\");</script>";
      echo("<script>location.replace('Main_wallet/Main_wallet.php');</script>");
      }else{
      echo '      삭제 실패';
      }

}


?>
