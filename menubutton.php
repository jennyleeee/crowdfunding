<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
<title>Menu Button</title>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
$(document).ready(function(){
$('.total').click(function(){
$(this).toggleClass('on');
});
});
</script>

<style>
body{background : e6b9f0;}
.total { display: block; position: absoulute; left:50%; top:50%; width: 200px; height: 200px; transform: translate(-50%,-50%); text-decoration: none;}
.total span { display: block; position; absoulute; top: 50%; width: 100%; height:30px; background:rgba(225,245,136,1); color: transparent; transform: translate(0,-50%); Transition:all 0.5s;}
.total span: before,
.total span: after{ content: ""; position: absoulute; left:0; top:0; width:100%; height: 30px; background: rgba(225,245,136,1);Transition:all 0.5s;}
.total span: before {top:-60px;}
.total span: after {top:60px;}
.total:on span{ background:rgba(225,245,136,0);}
.total:on span:before{top:0px; transform: rotate(45deg);}
.total:on span:afeter {top:0px; transform: rotate(-45deg);}



</style>


</head>



<body>
<a href ="#a" class="total">
<span>menu</span>
</a>

</body>
</html>
