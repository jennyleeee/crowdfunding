<?php

// echo '입력한 title :'. $_POST['Num'].','.'입력한 contents : '.$_GET['Num'];


$servername = "127.0.0.1";
$username = "jaeun";
$password = "1234";
$db="memberDB";

// Create connection
$conn = new mysqli($servername,$username,$password,$db);


//$_GET['bno']이 있어야만 글삭제가 가능함.

	if(isset($_GET['Num'])) {
		$co_no= $_GET['Num'];
	}


if(isset($co_no)){
    $sql = 'delete from comment where co_no = ' . $co_no;
    if($conn->query($sql)){
      echo "<script>alert(\"정상적으로 댓글이 삭제되었습니다.\");</script>";
      echo("<script>location.replace('Main_wallet/Main_wallet.php');</script>");
      }else{
      echo '      삭제 실패';
      }

}


?>
