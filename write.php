
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php session_start();
date_default_timezone_set('Asia/Seoul');?>

<?php

 // echo '입력한 title :'. $_GET['Num'].','.'입력한 contents : '.$_GET['board_num'];
// echo '입력한 title :'. $_POST['today'].','.'입력한 name : '.$_POST['name'];

$servername = "127.0.0.1";
$username = "jaeun";
$password = "1234";
$db="memberDB";

// Create connection
$conn = new mysqli($servername,$username,$password,$db);

//$_GET['bno']이 있을 때만 $bno 선언
if(isset($_GET['Num'])) {
  $board_num = $_GET['Num'];
}



if(isset($board_num)) {
  $sql = 'select board_title, board_content from memberboard where board_num = ' . $board_num;
  $result = $conn->query($sql) or die($conn->error);
  $row = $result->fetch_assoc();
}

?>


<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>글 작성하기 :)</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
<table class="table table-bordered">
    <thead>
        <caption> <strong> 글쓰기 </strong> </caption>
    </thead>
    <tbody>
        <form  method="post" encType="multiplart/form-data" action="write_ok.php">

          <?php
				if(isset($board_num)) {
					echo '<input type="hidden" name="Num" value="' . $board_num . '">';
				}
				?>

            <tr>
                <th>제목: </th>
                <td><input type="text" placeholder="제목을 입력하세요. " name="title" class="form-control" value="<?php echo isset($row['board_title'])?$row['board_title']:null?>"/></td>
            </tr>
            <tr>
                <th>내용: </th>
                <td><textarea cols="10" rows="20" placeholder="내용을 입력하세요. " name="content" class="form-control"><?php echo isset($row['board_content'])?$row['board_content']:null?></textarea></td>
            </tr>

            <input type="hidden" name="name" value="<?=$_SESSION['name']?>">
            <input type="hidden" name="today" value="<?=date("Y-m-d");?>">

            <!-- <tr>
                <th>첨부파일: </th>
                <td><input type="text" placeholder="파일을 선택하세요. " name="filename" class="form-control"/></td>
            </tr> -->

            <tr>
                <td colspan="2">
                    <button type="submit" onclick="sendData()" value="등록" class="pull-right"> <?php echo isset($board_num)?'수정':'작성'?> </button>

                    <input type="button" value="취소" class="pull-right" onclick="javascript:location.href='list.jsp'"/>
                    <!-- <a class="btn btn-default" onclick="sendData()"> 등록 </a>
                    <a class="btn btn-default" type="reset"> reset </a>
                    <a class="btn btn-default" onclick="javascript:location.href='list.jsp'">글 목록으로...</a> -->
                </td>

            </tr>
        </form>
    </tbody>
</table>
</div>
</body>
</html>
