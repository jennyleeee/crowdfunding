
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php
session_start();?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> 글 상세보기 :) </title>
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
        <caption> <strong> 게시물 확인하기 </strong> </caption>
    </thead>
    <tbody>


      <?php
      $servername = "127.0.0.1";
      $username = "jaeun";
      $password = "1234";
      $db="memberDB";

      // Create connection
      $conn = new mysqli($servername,$username,$password,$db);

      $board_num = $_GET['Num'];
      $sql = 'select board_title, board_content, board_date, board_writer from memberboard where board_num = ' . $board_num;
      $result = $conn->query($sql);

      $row = $result->fetch_assoc();


      if(!isset($_SESSION['name'])) {
        echo"<script> alert('로그인 해주세요!');</script>";
         echo"<script> window.history.back()</script>";
         exit();
      }


      ?>

            <tr>
                <th>제목: </th>
                <td><type="text" name="title" class="form-control"/><?php echo $row['board_title']?></td>
            </tr>
            <tr>
                <th>내용: </th>
                <td> <type="text" style="height:400px;" name="content" class="form-control"><?php echo $row['board_content']?></textarea></td>
            </tr>


            <tr>
                <th>작성자: </th>
                <td><type="text"  name="filename" class="form-control"/><?php echo $row['board_writer']?></td>
            </tr>

            <tr>
                <th>작성날짜: </th>
                <td><type="text"  name="filename" class="form-control"/><?php echo $row['board_date']?></td>
            </tr>


            <tr>
                <td colspan="2">
                  <?php
                  if($_SESSION['name'] == $row['board_writer']){
                  ?>
                 <a href="write.php?Num=<?php echo $board_num?>"> <button class="pull-right">  수정</button> </a>
                  <?php
                  }
                  ?>

                    <?php
                    if($_SESSION['name'] == $row['board_writer']){
                    ?>
                    <a  href="delete.php?Num=<?php echo $board_num?>"><button class="pull-right" onClick="return confirm('삭제하시겠습니까?')"> 삭제 </button> </a>
                    <?php
                    }
                    ?>
                    <a href="Main_wallet/Main_wallet.php"><button  class="pull-right">목록으로</button> </a>
                </td>
            </tr>
    </tbody>
</table>
</div>


<!-- 댓글뜨는 부분!!!!!!! -->


<div class="container" id="commentView">
    <input type="hidden" name="Num" value="<?php echo $board_num?>"/>
    <table class="table" frame=void>
      <colgroup>
        <col style="width:40%">
        <col style="width:15%">
        <col style="width:20%">
        <col style="width:20%">
    <thead>
        <caption> <strong> 댓글 확인하기 </strong> </caption>
        <tr>
          <th>댓글 내용</th>
          <th>작성자</th>
          <th>작성 시간</th>
        </tr>
    </thead>
<tbody>
  <?php
  $servername = "127.0.0.1";
  $username = "jaeun";
  $password = "1234";
  $db="memberDB";

  // Create connection
  $conn = new mysqli($servername,$username,$password,$db);
  $board_num = $_GET['Num'];
  	$sql = 'select * from comment where co_no=co_order and board_num=' . $board_num;
  	$result = $conn->query($sql);
  ?>
  <form action="comment_update.php" method="post">
          <?php
        		while($row = $result->fetch_assoc()) {
        	?>

        	<ul class="oneDepth">
        		<li>
        			<tr>
                <div id="co_<?php echo $row['co_no']?>" class="commentSet">

                <div class="commentInfo">

                <td class="Content"><?php echo $row['co_content']?></td>
        				<td class="Name"><span class="commentName"><?php echo $row['co_writer']?></td>
                <td class="Time"><?php echo $row['co_date']?></td>


                <div class="commentBtn">
			          <td class="comt write"> <a href="#" >답글달기</a></td>




                <?php
                if($_SESSION['name'] == $row['co_writer']){
                ?>
                  <td class="comt delete" onclick="return confirm('해당 댓글을 삭제하시겠습니까?')"> <a  href="delete_comment.php?Num=<?=$row['co_no']?>">삭제 </a></td>
                <?php
                }
                ?>

                <!-- <td  class="comt delete"> <a href="#">x</a></td> -->
		            </div>

              </div>

  </div>

        			</tr>
        			<?php
        				$sql2 = 'select * from comment where co_no!=co_order and co_order=' . $row['co_no'];
        				$result2 = $conn->query($sql2);
        				while($row2 = $result2->fetch_assoc()) {
        			?>

        			<ul class="twoDepth">
                <div id="co_<?php echo $row2['co_no']?>" class="commentSet">
                  <li>
							<div class="commentInfo">


        					<tr>
        						<td class="Name"><?php echo $row2['co_writer']?></td>
        						<td class="Content"><?php echo $row2['co_content'] ?></td>
        					</tr>

                  <div class="commentBtn">
                    <td  class="comt modify"> <a href="#">수정</a></td>
                    <td  class="comt delete"> <a href="#">삭제</a></td>
    		            </div>
                  </div>
        				</li>
        			</ul>
        			<?php
        				}
        			?>
        		</li>
        	</ul>
        	<?php } ?>


</tbody>

  </table>

</form>

<!-- 자바스크립트 부분 시작 -->


</div>
</div>



<div class="container">
<table class="table table-bordered">
    <thead>
        <caption> <strong> 댓글 달기 </strong> </caption>
    </thead>
    <tbody>


      <?php
      $servername = "127.0.0.1";
      $username = "jaeun";
      $password = "1234";
      $db="memberDB";



      // Create connection
      $conn = new mysqli($servername,$username,$password,$db);

      $board_num = $_GET['Num'];
      $sql = 'select board_title, board_content, board_date, board_writer from memberboard where board_num = ' . $board_num;
      $result = $conn->query($sql);

      $row = $result->fetch_assoc();

      date_default_timezone_set('Asia/Seoul');

      ?>


      <form action="comment_update.php" method="post">

      	<input type="hidden" name="Num" value="<?php echo $board_num?>">
        <input type="hidden" name="name" value="<?php echo$_SESSION['name']?>">
          <input type="hidden" name="time" value="<?=date("Y-m-d H:i:s");?>">
            <tr>
                <th>댓글: </th>
                <td> <textarea name="coContent"  id="coContent" style="height:40px;" class="form-control"></textarea></td>

            </tr>



            <tr>
                <td colspan="2">

                    <input type="submit" class="pull-right" value="코멘트 작성" />


                </td>

            </tr>


    </tbody>
</table>
</div>






</body>
</html>
