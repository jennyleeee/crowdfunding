<?php
date_default_timezone_set('Asia/Seoul');

$servername = "127.0.0.1";
$username = "jaeun";
$password = "1234";
$db="memberDB";

               // Create connection
$conn = new mysqli($servername,$username,$password,$db);
$conn->set_charset('utf8');

$board_num = $_POST['Num'];
$coContent = $_POST['coContent'];
$name = $_POST['name'];

	$sql = 'insert into comment values(null, ' .$board_num . ', null, "' . $coContent . '",null,  "' .$name . '")';

	$result = $conn->query($sql) or die($conn->error);
	$coNo = $conn->insert_id;
  $sql = 'update comment set co_order = co_no where co_no = ' . $coNo;
  $result = $conn->query($sql)  or die($conn->error);
  if($result or die($conn->error)) {
?>

	<script>

		alert('댓글이 정상적으로 작성되었습니다.');
		location.replace("view.php?Num=<?php echo $board_num?>");
	</script>

<?php
	}
?>
