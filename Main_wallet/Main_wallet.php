<!DOCTYPE html>
<?php session_start(); ?>
<?php
               $servername = "127.0.0.1";
               $username = "jaeun";
               $password = "1234";
               $db="memberDB";

               // Create connection
               $conn = new mysqli($servername,$username,$password,$db);
               $conn->set_charset('utf8');


               if(isset($_GET['page'])) {
                 $page = $_GET['page'];
                  } else {
               $page = 1;
             }        //비어있다면 1로 값을 지정


             $sql = 'select count(*) as cnt from memberboard order by board_num desc';
               $result = $conn->query($sql) ;
              $row = $result->fetch_assoc();


              $allPost = $row['cnt']; //전체 게시글의 수
              $onePage = 15; // 한 페이지에 보여줄 게시글의 수.
              $allPage = ceil($allPost / $onePage); //전체 페이지의 수 ceil: 올림을 나타냅

               if($page < 1 || ($allPage && $page > $allPage)) {
               ?>
               <script>
                           alert("존재하지 않는 페이지입니다.");
                           history.back();
                       </script>
                   <?php
                           exit;
                       }
  $oneSection = 10; //한번에 보여줄 총 페이지 개수(1 ~ 10, 11 ~ 20 ...) 블럭에 나타낼 페이지 번호 갯수
  $currentSection = ceil($page / $oneSection); //현재 섹션  현재 리스트의 블럭을 구하는 식
  $allSection = ceil($allPage / $oneSection); //전체 섹션의 수
  $firstPage = ($currentSection * $oneSection) - ($oneSection - 1); //현재 섹션의 처음 페이지  현재 블럭에서 시작페이지 번호

 if($currentSection == $allSection) {
     $lastPage = $allPage; //현재 섹션이 마지막 섹션이라면 $allPage가 마지막 페이지가 된다.
 } else {
     $lastPage = $currentSection * $oneSection; //현재 섹션의 마지막 페이지
 }
 $prevPage = (($currentSection - 1) * $oneSection); //이전 페이지, 11~20일 때 이전을 누르면 10 페이지로 이동.
 $nextPage = (($currentSection + 1) * $oneSection) - ($oneSection - 1); //다음 페이지, 11~20일 때 다음을 누르면 21 페이지로 이동.
$paging = '<ul>'; // 페이징을 저장할 변수
//첫 페이지가 아니라면 처음 버튼을 생성

   if($page != 1) {
       $paging .= '<li class="page page_start"><a href="Main_wallet.php?page=1">처음</a></li>';
   }

   //첫 섹션이 아니라면 이전 버튼을 생성

   if($currentSection != 1) {
       $paging .= '<li class="page page_prev"><a href="Main_wallet.php?page=' . $prevPage . '">이전</a></li>';
   }


   for($i = $firstPage; $i <= $lastPage; $i++) {
       if($i == $page) {
           $paging .= '<li class="page current">' . $i . '</li>';
       } else {
           $paging .= '<li class="page"><a href="Main_wallet.php?page=' . $i . '">' . $i . '</a></li>';
       }
   }

 //마지막 섹션이 아니라면 다음 버튼을 생성

 if($currentSection != $allSection) {
     $paging .= '<li class="page page_next"><a href="Main_wallet.php?page=' . $nextPage . '">다음</a></li>';
 }
//마지막 페이지가 아니라면 끝 버튼을 생성
   if($page != $allPage) {
       $paging .= '<li class="page page_end"><a href="Main_wallet.php?page=' . $allPage . '">끝</a></li>';
   }
   $paging .= '</ul>';

     $currentLimit = ($onePage * $page) - $onePage; //몇 번째의 글부터 가져오는지
     $sqlLimit = ' limit ' . $currentLimit . ', ' . $onePage; //limit sql 구문
   $sql = 'select * from memberboard order by board_num desc' . $sqlLimit; //원하는 개수만큼 가져온다. (0번째부터 20번째까지
 $result = $conn->query($sql);
?>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>노르낫이 만든 PVC 갬성 서브지갑</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link href="css/agency.min.css" rel="stylesheet">
    <link href="css/tab.css" rel="stylesheet">

  </head>

  <body id="page-top">

<?php include 'nav.php';?>
   <!-- Header -->
    <header class="masthead">
      <div class="container">
        <div class="intro-text">
          <div class="intro-heading text-uppercase"> [앵콜전] 노르낫이 만든 PVC 갬성 <br> <br> 서브지갑. 두번째 </div>
          <p> <br> </p>
          <div class="intro-lead-in">노르낫</div>
        </div>
      </div>
    </header>

    <!-- Services -->
    <!-- Services -->
       <!-- <section id="services">
         <div class="container">
           <div class="row">
             <div class="col-lg-12 text-center">
               <h2 class="section-heading text-uppercase">에디터 추천 프로젝트</h2>
               <h3 class="section-subheading text-muted">에디터가 추천한 프로젝트를 둘러보세요!</h3>
             </div>
           </div>
           <!-- <div class="row text-center">
             <div class="col-md-4">
               <span class="fa-stack fa-4x">
                 <i class="fa fa-circle fa-stack-2x text-primary"></i>
                 <i class="fa fa-shopping-cart fa-stack-1x fa-inverse"></i>
               </span>
               <h4 class="service-heading">E-Commerce</h4>
               <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
             </div>
             <div class="col-md-4">
               <span class="fa-stack fa-4x">
                 <i class="fa fa-circle fa-stack-2x text-primary"></i>
                 <i class="fa fa-laptop fa-stack-1x fa-inverse"></i>
               </span>
               <h4 class="service-heading">Responsive Design</h4>
               <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
             </div>
             <div class="col-md-4">
               <span class="fa-stack fa-4x">
                 <i class="fa fa-circle fa-stack-2x text-primary"></i>
                 <i class="fa fa-lock fa-stack-1x fa-inverse"></i>
               </span>
               <h4 class="service-heading">Web Security</h4>
               <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
             </div>
           </div> -->
         </div>
       </section>

       <div id="css_tabs">
           <input id="tab1" type="radio" name="tab" checked="checked" />
           <input id="tab2" type="radio" name="tab" />
           <input id="tab3" type="radio" name="tab" />
           <label for="tab1">스토리</label>
           <label for="tab2">커뮤니티</label>
           <label for="tab3">환불 및 교환</label>




 <div class="tab1_content">

    <!-- Portfolio Grid -->
    <section class="bg-light" id="portfolio">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">


              <h2></h2>
              <h2></h2>


              <img class="img-fluid" src="img/pvc wallet.jpg" alt="" style="float:left" >

              <h2 class="section-subheading text-muted">모인금액</h2>
                <h2 class="section-heading text-uppercase">7,571,000원</h2>

              <h2 class="section-subheading text-muted">남은시간  </h2>
                <h2 class="section-heading text-uppercase">6일</h2>

                <h2 class="section-subheading text-muted">후원자</h2>
                  <h2 class="section-heading text-uppercase">208명</h2>


                <h4>펀딩 진행중</h4>
                <p class="text-muted">목표 금액인 700,000원이 모여야만 결제됩니다.<br>결제는 2018년 7월 21일에 다함께 진행됩니다.</p>

                  <button type="button" class="btn btn-danger">프로젝트 밀어주기</button>



          </div>
        </div>
      </div>
    </section>




    <!-- About -->
    <section id="about">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
              <h3 class="text-muted">※ 500% 달성 기념 이벤트 진행중! <br>(자세한 내용은 커뮤니티 참고) </h3>
              <img class="img-fluid" src="img/intro_wallet.jpg" alt="">
              <h2 class="text-muted">INTRO </h2>
                <h2 class="text-muted">  </h2>
                  <h2 class="text-muted">   </h2>

            <h3 class="section-subheading text-muted"  style='line-height:200%'> 노르낫이 전개하는 PVC 라인을 소개 합니다.
요즘 PVC 소재의 가방 많이들 보셨죠? 트렌드이긴 하지만 가격이나 디자인이 약간 부담스럽더라고요. 그래서 노르낫이 우리만의 스타일로 만들어 보았습니다.^^
단순히 플라스틱 소재의 퀄리티 낮은 제품이 아니라 노르낫이 만든 특별한 제품입니다.
노르낫의 PVC 라인이 다른 제품들과 다른점은 제품 컬러와 퀄리티입니다.
완전 투명한 소재가 아닌 브라운컬러의 PVC여서 안에 내용물이 잘 보이지 않고 완성도가 높아 가벼운 느낌이 아닌 고급스러운 무드가 있는 귀여운? 제품입니다.
계속적인 관심을 보여주신 많은 분들께 감사의 말씀을 전하며 노르낫의 PVC Collection을 소개합니다.</h3>
          </div>
        </div>
      </div>
    </section>



        <section id="about">
          <div class="container">
            <div class="row">
              <div class="col-lg-12 text-center">

                  <img class="img-fluid" src="img/1.jpg" alt=""  vspace=50>

                  <img class="img-fluid" src="img/2.jpg" alt="" vspace=50>


                  <img class="img-fluid" src="img/3.jpg" alt="" vspace=50>


                  <h2 class="text-muted">Why Nornot? Why PVC? <br> <p> 2018년 여름과 가을을 강타할 PVC아이템. </h2>

                <h3 class="section-subheading text-muted"  style='line-height:200%'>
                  PVC로 만든 극강무드 서브지갑 컬렉션은 더워 보이거나 투박한 소재가 아닌 가볍고 시원시원한
                  PVC 소재를 이용 하였으며 양가죽과 노르낫 전용 단추캡으로 퀄리티를 높였습니다.
                    또한, 브라운 PVC로 완전히 투명하지 않아 그렇게 과감할 필요도 없습니다. (밤에 들면 더 이쁨니다)
                    그저 나에게 주는 작은 선물로 바쁜 일상 속에 작은 힐링이 됐으면 하는 마음으로 만들었습니다.</h3>


                    <img class="img-fluid" src="img/4.jpg" alt=""  vspace=50>

                    <img class="img-fluid" src="img/5.jpg" alt="" vspace=50>


                    <img class="img-fluid" src="img/6.jpg" alt="" vspace=50>


                    <h3 class="section-subheading text-muted"  style='line-height:200%'>
                      노르낫이 만든 PVC서브지갑은 키링을 손가락에 끼워 사용할 수 있어 두 손이 자유로우며 여행지에서 간편하게 들고
                      다니거나 가벼운 외출시 너무 좋습니다.
                      이 키링은 각자의 사용 방법에 따라 지갑 안쪽으로 집어넣어 짧게(길이조절 가능) 사용할 수도 있습니다.
                      지갑과 클러치백 세트로 사용하시면 좋습니다.</h3>

                      <p></p>
                        <p></p>
                        <p></p>
                        <p></p>
                        <p></p>
                        <p></p>
                        <p></p>
                        <p></p>

                        <p></p>

                        <h2 class="section-heading text-uppercase">[앵콜전] 블랙 컬러 추가 </h2>
                        <p></p>

                        <h3 class="section-subheading text-muted"  style='line-height:200%'>
                          1차때 많은 후원자님들이 컬러가 다양하지 않다는 피드백을 주셔서 2차로 진행하는 이번 프로젝트에는 블랙 컬러가 추가 되었습니다.
                          블랙컬러로 더 시크하게 사용하실 수 있으며 여성 뿐만 아니라 남성분들도 이용이 가능하십니다.</h3>
                          <p></p>

                          <h2 class="section-heading text-uppercase">PVC_속이 살짝살짝 보이는 은은함, 시원함. </h2>
                        <p></p>
                            <h3 class="section-subheading text-muted"  style='line-height:200%'>
                            PVC 하면 소재의 특성상 안에 넣은 물건이 보이는데, 너무 잘 보이는 것이 다소 부담스러울 수 있다고 생각했습니다.
                            그래서 노르낫은 브라운 PVC로 제작하여 투명도를 낮춰 부담스럽지 않으면서
                            적당히 시원하고 고급스러운 우리만의 색감을 찾았으며 이런 이유로 너무 차가워 보이지 않는것이 특징입니다.
                            여름뿐만 아니라 가을에도 들 수 있습니다. (밤에 들어도 이뻐요)</h3>
                          <p></p>



                          <h2 class="section-heading text-uppercase">무엇이 얼마나 들어갈까요? </h2>



                          <img class="img-fluid" src="img/9.jpg" alt="" vspace=50>


                          <img class="img-fluid" src="img/10.jpg" alt="" vspace=50>

                              <img class="img-fluid" src="img/11.jpg" alt="" vspace=50>

                              <h3 class="section-subheading text-muted"  style='line-height:200%'>
                                키링 스퀘어 지갑과, 키링 클러치백 모두 수납공간이 두 곳이어서 물건의 크기나 사용빈도에 따라 편하게 사용하실 수 있습니다.
                                지갑은 가방안에 넣고 다니는 서브지갑으로 사용하기에 적합하며 클러치백은 장지갑이나 썬그라스 등 큰 물건들이
                                 잘 들어가 메인 가방으로 외출 하시기에 좋습니다.
                                 그리고 물건을 약간 가리고 싶다면 밖에 포켓에는 아무것도 넣지 않고 안쪽 포켓만
                                 이용하면 PVC가 한 겹 더 있기 때문에 투명도를 낮출 수 있습니다.
                                 지갑과 클러치백 세트로 사용하시면 좋습니다</h3>

                                 <p></p>
                                  <p></p>
                                   <p></p>
                                    <p></p>
                                     <p></p>
                                      <p></p>
                                       <p></p>
                                        <p></p>

                                        <h2 class="section-heading text-uppercase">NORNOT Numbering...  </h2>

                                          <img class="img-fluid" src="img/12.jpg" alt="" vspace=50>
                                     <h3 class="section-subheading text-muted"  style='line-height:200%'>
                                       노르낫의 모든 제품에는 각기 다른 넘버링이 부여되고
                                       이 제품 번호를 브랜드화하여 브랜드에 사용자가 맞추는 것이
                                       아닌 사용자에 따른 자신만의 아이덴티티를 부여합니다.

                                    이 넘버링은 제품의 종류와 소재 등을 나타내며 노르낫만의 방법으로 부여됩니다. </h3>



                                    <h2 class="section-heading text-uppercase">후원금 사용계획 </h2>
                                    <p></p>
                                    <p></p>

                                    <p></p>
                                    <h3 class="section-subheading text-muted"  style='line-height:200%'>
                                      노르낫은 이번 펀딩을 통해 브랜드를 알리는데 집중하였습니다.
  따라서 노르낫은 꼭 필요한 금액을 제외하고는 가격거품을 완전히 낮추었습니다.
  거의 모든 부분이 제품 제작 비용으로 활용되며 이렇게 마진을 얼마 남기지 않는 이유는 오직 노르낫 제품을 많은 분들께 알리기 위한 노르낫의 선택입니다.
  합리적인 가격으로, 올 여름 기분좋은 아이템이 되기 위해 최선을 다하겠습니다.
<p>
  ※ 텀블벅 펀딩이 종료 된 이후에 노르낫 자사몰과 미국 아마존에서 더 높은 가격으로 판매 될 예정입니다. </p></h3>


  <h2 class="section-heading text-uppercase">ABOUT US  </h2>
  <p></p>
  <p></p>

  <p></p>
  <h3 class="section-subheading text-muted"  style='line-height:200%'>
    노르낫은요.
브랜딩을 전공하고 가방을 직접 만들며 이태리 장인이 만든 가방을 검품하고 수리까지 하는 등 가방의 모든 것을 배우며 일해온 한 청년이 만든 브랜드입니다.
첫 번째 직장으로 브랜딩 회사를 거쳐 가방전문 가죽 학교에서 가방 제작을 배웠으며, 이후에 경영과 판매를 배우고자 유럽 명품 브랜드를 수입/전개하는 곳으로 일터를 옮겨 가방 및 뷰티 브랜드들을 관리(Branding, MD)하는 일을 해왔습니다.
그 후에 독립하여 TMBN이라는 패션 그룹을 설립하고 그 첫 번째 브랜드로 NORNOT(노르낫)을 런칭하게 되었습니다. 어찌 보면 살아온 모든 날이 가방 브랜드를 만들기 위한 여정이었던 거 같아요.^^
<p>
※ 텀블벅 펀딩이 종료 된 이후에 노르낫 자사몰과 미국 아마존에서 더 높은 가격으로 판매 될 예정입니다. </p></h3>
  <img class="img-fluid" src="img/13.jpg" alt="" vspace=50>
  <h3 class="section-subheading text-muted"  style='line-height:200%'>
    노르낫은 단순 잡화 제품에만 국한되지 않고 패션 부분의 다양한 영역까지 확장하는 것을 목표로 합니다. 이제까지 보지 못했던 신선하고 믿을 수 있는 다양한 제품을 출시하도록 최선을 다하겠으며 노르낫이 가지는 비전과 가치를 실현해 나갈 수 있도록 많은 관심과 응원 부탁드립니다.
<br>  노르낫 웹사이트 : www.nornot.net
    </p></h3>

    <h2 class="section-heading text-uppercase">NORNOT in USA.  </h2>
    <p></p>
    <p></p>

    <p></p>
    <h3 class="section-subheading text-muted"  style='line-height:200%'>
      노르낫 미국 진출하다.
  노르낫은 작년(2017) 11월 정식 런칭을 하고 올해 초 아마존에 입점하여
   비교적 빠른 시기에 미국 시장에 진출할 수 있는 기회를 얻었습니다.
  현재 미국 아마존에 입점하여 미국뿐만 아니라 전 세계에 노출이 되고 있으며,
  미국 아마존 측과 협의하여 펀딩이 진행되고 있는 7월 16일 일본 진출에 대한 1차 미팅이 예정되어 있습니다.</p></h3>
  <img class="img-fluid" src="img/14.jpg" alt="" vspace=50>


  <p></p>
  <p></p>

  <p></p>

  <h2 class="section-heading text-uppercase">BRAND CONCEPT </h2>
  <p></p>
  <p></p>

  <p></p>
  <h3 class="section-subheading text-muted"  style='line-height:200%'>
  노르낫의 네임은 Normal과 Not의 합성어로 만들어져 평범하지 않음을 추구하는 브랜드로 뻔하지 않으면서
   적당히 다른, <br> 딱 우리가 원하는 그런 제품을 만들기 위해 노력합니다.</p></h3>

     <h5 class="section-heading text-uppercase">NORMAL + NOT = NORNOT <br>
Basic but Not Normal </h5>

<img class="img-fluid" src="img/15.jpg" alt="" vspace=50>


<h2 class="section-heading text-uppercase">많이 물어보는 질문 </h2>
<h3 class="section-subheading text-muted"  style='line-height:200%'>
  Q. 본 제품은 남녀 공용이에요? <br>
  A. 아니요. 여성을 위해 만든 제품입니다. 여성에게 양보하세요. <br>
     (하지만 양보하지 않겠다는 남성분들이 꽤 있어 정정합니다. 말리지 않습니다.^^)
<p>
  <p>
  Q. 주의사항이 있습니까?<br>
  A. PVC특성상 뾰족한 물건으로 충격을 가하면 스크레치가 생길 수 있으며 뜨거운 열을 피해서 사용할 것을 권장 드립니다. <br>
  그리고 너무 많이 넣지 마세요. 안에 내용물이 많으면 안 이뻐요.
<p>
  <p>
  Q. 제품앞에 넘버는 무엇을 의미하나요? <br>
  A. 노르낫의 모든 제품에는 넘버링이 부여됩니다. 제품의 시기, 소재, 종류, 등의 정보가 담겨져 있습니다. <br>
   (노르낫의 보증서, 패키지 등 숫자가 다 다릅니다. 잘못 보낸것이 아닙니다.)
<p>
  <p>
  Q. 선물 포장이 있나요?<br>
  A. 죄송하지만 마진을 최소화 하기 위해 선물포장은 없습니다. 이해 부탁드립니다.<br>
  (포장은 깨끗한 종이 패키지를 이용하며 택배박스에 완충제를 넣어 안전하게 배송됩니다.)
  <p>
    <p>

  Q. 배송은 언제부터 시작 되나요?<br>
  A. 프로젝트가 종료되기 전부터 미리 제작에 들어가기 때문에 예상 출고일보다 먼저 보내드릴 수도 있습니다. 수시로 진행 상황은 알려 드리겠습니다.<br>
  <p>
    <p>
  Q. 펀딩 전, 꼭 확인해야 하는 사항이 있나요?<br>
  A. 배송일을 반드시 확인해 주시기 바랍니다.</h3>

              </div>
            </div>
          </div>
        </section>




    <!-- Clients -->
    <section class="py-5">
      <div class="container">
        <div class="row">
          <div class="col-md-3 col-sm-6">
            <a href="#">
              <img class="img-fluid d-block mx-auto" src="img/logos/envato.jpg" alt="">
            </a>
          </div>
          <div class="col-md-3 col-sm-6">
            <a href="#">
              <img class="img-fluid d-block mx-auto" src="img/logos/designmodo.jpg" alt="">
            </a>
          </div>
          <div class="col-md-3 col-sm-6">
            <a href="#">
              <img class="img-fluid d-block mx-auto" src="img/logos/themeforest.jpg" alt="">
            </a>
          </div>
          <div class="col-md-3 col-sm-6">
            <a href="#">
              <img class="img-fluid d-block mx-auto" src="img/logos/creative-market.jpg" alt="">
            </a>
          </div>
        </div>
      </div>
    </section>

    <!-- Contact -->
    <section id="contact">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase">Contact Us</h2>
            <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <form id="contactForm" name="sentMessage" novalidate="novalidate">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <input class="form-control" id="name" type="text" placeholder="Your Name *" required="required" data-validation-required-message="Please enter your name.">
                    <p class="help-block text-danger"></p>
                  </div>
                  <div class="form-group">
                    <input class="form-control" id="email" type="email" placeholder="Your Email *" required="required" data-validation-required-message="Please enter your email address.">
                    <p class="help-block text-danger"></p>
                  </div>
                  <div class="form-group">
                    <input class="form-control" id="phone" type="tel" placeholder="Your Phone *" required="required" data-validation-required-message="Please enter your phone number.">
                    <p class="help-block text-danger"></p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <textarea class="form-control" id="message" placeholder="Your Message *" required="required" data-validation-required-message="Please enter a message."></textarea>
                    <p class="help-block text-danger"></p>
                  </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-lg-12 text-center">
                  <div id="success"></div>
                  <button id="sendMessageButton" class="btn btn-primary btn-xl text-uppercase" type="submit">Send Message</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <span class="copyright">Copyright &copy; Your Website 2018</span>
          </div>
          <div class="col-md-4">
            <ul class="list-inline social-buttons">
              <li class="list-inline-item">
                <a href="#">
                  <i class="fa fa-twitter"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fa fa-facebook"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fa fa-linkedin"></i>
                </a>
              </li>
            </ul>
          </div>
          <div class="col-md-4">
            <ul class="list-inline quicklinks">
              <li class="list-inline-item">
                <a href="#">Privacy Policy</a>
              </li>
              <li class="list-inline-item">
                <a href="#">Terms of Use</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>

    <!-- Portfolio Modals -->

    <!-- Modal 1 -->
    <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="close-modal" data-dismiss="modal">
            <div class="lr">
              <div class="rl"></div>
            </div>
          </div>
          <div class="container">
            <div class="row">
              <div class="col-lg-8 mx-auto">
                <div class="modal-body">
                  <!-- Project Details Go Here -->
                  <h2 class="text-uppercase">Project Name</h2>
                  <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                  <img class="img-fluid d-block mx-auto" src="img/portfolio/01-full.jpg" alt="">
                  <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                  <ul class="list-inline">
                    <li>Date: January 2017</li>
                    <li>Client: Threads</li>
                    <li>Category: Illustration</li>
                  </ul>
                  <button class="btn btn-primary" data-dismiss="modal" type="button">
                    <i class="fa fa-times"></i>
                    Close Project</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal 2 -->
    <div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="close-modal" data-dismiss="modal">
            <div class="lr">
              <div class="rl"></div>
            </div>
          </div>
          <div class="container">
            <div class="row">
              <div class="col-lg-8 mx-auto">
                <div class="modal-body">
                  <!-- Project Details Go Here -->
                  <h2 class="text-uppercase">Project Name</h2>
                  <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                  <img class="img-fluid d-block mx-auto" src="img/portfolio/02-full.jpg" alt="">
                  <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                  <ul class="list-inline">
                    <li>Date: January 2017</li>
                    <li>Client: Explore</li>
                    <li>Category: Graphic Design</li>
                  </ul>
                  <button class="btn btn-primary" data-dismiss="modal" type="button">
                    <i class="fa fa-times"></i>
                    Close Project</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal 3 -->
    <div class="portfolio-modal modal fade" id="portfolioModal3" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="close-modal" data-dismiss="modal">
            <div class="lr">
              <div class="rl"></div>
            </div>
          </div>
          <div class="container">
            <div class="row">
              <div class="col-lg-8 mx-auto">
                <div class="modal-body">
                  <!-- Project Details Go Here -->
                  <h2 class="text-uppercase">Project Name</h2>
                  <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                  <img class="img-fluid d-block mx-auto" src="img/portfolio/03-full.jpg" alt="">
                  <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                  <ul class="list-inline">
                    <li>Date: January 2017</li>
                    <li>Client: Finish</li>
                    <li>Category: Identity</li>
                  </ul>
                  <button class="btn btn-primary" data-dismiss="modal" type="button">
                    <i class="fa fa-times"></i>
                    Close Project</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal 4 -->
    <div class="portfolio-modal modal fade" id="portfolioModal4" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="close-modal" data-dismiss="modal">
            <div class="lr">
              <div class="rl"></div>
            </div>
          </div>
          <div class="container">
            <div class="row">
              <div class="col-lg-8 mx-auto">
                <div class="modal-body">
                  <!-- Project Details Go Here -->
                  <h2 class="text-uppercase">Project Name</h2>
                  <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                  <img class="img-fluid d-block mx-auto" src="img/portfolio/04-full.jpg" alt="">
                  <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                  <ul class="list-inline">
                    <li>Date: January 2017</li>
                    <li>Client: Lines</li>
                    <li>Category: Branding</li>
                  </ul>
                  <button class="btn btn-primary" data-dismiss="modal" type="button">
                    <i class="fa fa-times"></i>
                    Close Project</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal 5 -->
    <div class="portfolio-modal modal fade" id="portfolioModal5" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="close-modal" data-dismiss="modal">
            <div class="lr">
              <div class="rl"></div>
            </div>
          </div>
          <div class="container">
            <div class="row">
              <div class="col-lg-8 mx-auto">
                <div class="modal-body">
                  <!-- Project Details Go Here -->
                  <h2 class="text-uppercase">Project Name</h2>
                  <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                  <img class="img-fluid d-block mx-auto" src="img/portfolio/05-full.jpg" alt="">
                  <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                  <ul class="list-inline">
                    <li>Date: January 2017</li>
                    <li>Client: Southwest</li>
                    <li>Category: Website Design</li>
                  </ul>
                  <button class="btn btn-primary" data-dismiss="modal" type="button">
                    <i class="fa fa-times"></i>
                    Close Project</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal 6 -->
    <div class="portfolio-modal modal fade" id="portfolioModal6" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="close-modal" data-dismiss="modal">
            <div class="lr">
              <div class="rl"></div>
            </div>
          </div>
          <div class="container">
            <div class="row">
              <div class="col-lg-8 mx-auto">
                <div class="modal-body">
                  <!-- Project Details Go Here -->
                  <h2 class="text-uppercase">Project Name</h2>
                  <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                  <img class="img-fluid d-block mx-auto" src="img/portfolio/06-full.jpg" alt="">
                  <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                  <ul class="list-inline">
                    <li>Date: January 2017</li>
                    <li>Client: Window</li>
                    <li>Category: Photography</li>
                  </ul>
                  <button class="btn btn-primary" data-dismiss="modal" type="button">
                    <i class="fa fa-times"></i>
                    Close Project</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Contact form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/agency.min.js"></script>
</div> <!-- ends of tab1-->
<div class="tab2_content">


<!-- <TEXTAREA NAME=txtComment COLS=70 ROWS=4> </TEXTAREA> <br>
<br>

<button type="button" class="btn btn-danger" > submit </button>
<p><br></p> -->

<?php

$servername = "127.0.0.1";
$username = "jaeun";
$password = "1234";
$db="memberDB";

// Create connection
$conn = new mysqli($servername,$username,$password,$db);
$conn->set_charset('utf8');

?>

<table class="table">
  <thead>
    <tr>
      <th>Num</th>
      <th>Title</th>
      <th>Name</th>
      <th>Date</th>
    </th>
  </thead>
<tbody>


  <?php
	$sql = 'select * from memberboard order by board_num desc';
  $result = $conn->query($sql) or die($conn->error) ;


while($row = $result->fetch_assoc())
{
   ?>

      <tr>
           <td class="Num"><?php echo $row['board_num']?></td>
 					<td class="Title"><a href="../view.php?Num=<?=$row['board_num']?>"><?php echo $row['board_title']?></a></td>
 					<td class="Name"><?php echo $row['board_writer']?></td>
 					<td class="Date"><?php echo $row['board_date']?></td>
 				</tr>
        <?php

        						}

        					?>

               </tbody>
               </table>

               <div class="paging" float="left"><?php echo $paging ?></div>


</tbody>
</table>



<!-- 로그인을 해야지만 글쓰기가능 -->

<?php
if(
  isset($_SESSION['name'])){
    ?>
    <a button type="button" class="btn btn-danger" href="../write.php" onclick="" style="position: absolute; left: 40;"> 작성하기 </button></a>
<?php }
else {
  ?>
  <?php
}
?>



<p><br></p>
      </div>





        <div class="tab3_content">


  <section>
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">이 프로젝트의 환불 및 교환 정책 </h2>
  <p class="text-muted" style='line-height:200%'>
    1) 단순 변심에 의한 환불은 불가능합니다. <br>
  2) 예상 전달일로부터 30일 이상 전달 지연 시 수수료 제외 후 환불 가능 합니다.<br>
  3) 파손, 불량품 수령시 7일 이내로 교환이 가능합니다. 교환 시 발생하는 배송비는 진행자 부담입니다.<br>
   (사용하시다가 발생된 하자는 교환이나 환불 사유가 되지 않습니다)<br>
  4) 후원자의 배송지 기재 오류, 후원자가 진행자에게 사전 고지 없이 배송지를 수정해 배송사고가 발생할 경우<br>
   진행자는 최대 2번까지 재발송 해드립니다. 배송비 부담은 후원자에게 있습니다.<br>
  5) 제품 포장 개봉 및 사용으로 훼손된 제품은 단순 변심에 의한 교환 또는 환불이 불가합니다.<br>
</p>
</div>
</div>
</div>
</section>

<section >
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <p class="text-muted">프로젝트에 대해 문의사항이 있으신가요?   <button type="button" class="btn btn-danger"> 창작자에게 문의하기 </button> </p>
</div>
</div>
</div>
</section>


             </div>
       </div><!--ends of Tab-->
</html>
