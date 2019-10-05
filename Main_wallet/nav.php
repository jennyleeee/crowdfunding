<!-- Navigation -->

<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
 <div class="container">
   <a class="menu-trigger type11" href="#">
       <span></span>
       <span></span>
       <span></span>
   </a>
   <a class="navbar-brand js-scroll-trigger" href="#page-top"> Project</a>


   <a class="navbar-brand js-scroll-trigger" href="../mainpage.php" > AwesomeJaeun</a>


   <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
   data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
     Menu
     <i class="fa fa-bars"></i>
   </button>
   <div class="collapse navbar-collapse" id="navbarResponsive">
     <ul class="navbar-nav text-uppercase ml-auto">
       <li class="nav-item">
         <a class="nav-link js-scroll-trigger" href="../Upload/upload.php" onclick="">프로젝트 올리기</a>

       </li>
       <li class="nav-item">


    <?php
       if(
         !isset($_SESSION['name'])) {
        echo " <a  href=\"../login/login.php\">로그인/회원가입</a>";
       // <a class="nav-link js-scroll-trigger" href=\"../login/login.php" onclick="">로그인/회원가입</a>";

     } else {
       $name = $_SESSION['name'];
             echo "<p><strong>$name</strong>님 환영합니다.";
             echo "<a class=\"nav-link js-scroll-trigger\" href=\"logout.php\">[로그아웃]</a></p>";
     }
    ?>
       </li>

     </ul>
   </div>
 </div>
</nav>
