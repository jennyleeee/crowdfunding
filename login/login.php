<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>로그인하기~~</title>


  <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
<link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900&subset=latin,latin-ext'>

      <link rel="stylesheet" href="css/style.css">


</head>

<body>

  <div class="materialContainer">


   <div class="box">

      <div class="title">LOGIN</div>
 <?php if(!isset($_SESSION['name']))  { ?>
   <form action="../login_check.php" method="post">
   <!-- <form action="login.php" method="post"> -->
      <div class="input">
         <label for="name">ID</label>
         <input type="text" name="name" id="name">
         <span class="spin"></span>
      </div>

      <div class="input">
         <label for="pass">Password</label>
         <input type="password" name="pass" id="pass">
         <span class="spin"></span>
      </div>

      <div class="button login">
         <button><span>GO</span> <i class="fa fa-check"></i></button>
      </div>
    </form>
  <?php } else {

             $name = $_SESSION['name'];
             echo "<p><strong>$name</strong></p> 님은 이미 로그인하고 있습니다. ";
             echo "<a href=\"../mainpage.php\">[돌아가기]</a> ";
             echo "<a href=\"logout.php\">[로그아웃]</a></p>";
         } ?>




      <a href="" class="pass-forgot">Forgot your password?</a>

   </div>

   <div class="overbox">
      <div class="material-button alt-2"><span class="shape"></span></div>

      <div class="title">REGISTER</div>


  <form method="post" action=membersave.php >
      <div class="input">
         <label for="regname">ID</label>
         <input type="text" name="regname" id="regname">
         <span class="spin"></span>
      </div>


      <div class="input">
         <label for="regpass">Password</label>
         <input type="password" name="regpass" id="regpass">
         <span class="spin"></span>
      </div>

      <div class="input">
         <label for="reregpass">Repeat Password</label>
         <input type="password" name="reregpass" id="reregpass">
         <span class="spin"></span>
      </div>

      <div class="button">
         <button><span>REGISTER</span></button>
      </div>


</post>
   </div>

</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>



    <script  src="js/index.js"></script>





</body>

</html>
