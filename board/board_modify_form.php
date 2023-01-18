<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>게시판</title>
	<link rel="stylesheet" type="text/css" href="../maincss/header.css?after">
    <link rel="stylesheet" type="text/css" href="../maincss/footer.css?after">
	<link rel="stylesheet" type="text/css" href="./css/board.css">
	<script src="./js/board.js"></script>
</head>
<body> 
	<header>
<?php 
        include "../main/header_top.php";
        include "../main/header.php";
?>
    </header> 
	<div class="header_down_img">
        <img src="../img/counseling3.jpg" alt="">
    </div>
	<section>
   		<div class="board_box">
	    <h3 class="board_title">게시판 > 글 쓰기</h3>
<?php
	include("../dbconnector/db_connect.php");
	$userid = isset($_SESSION["id"]) ? $_SESSION["id"] : "";
	$username = isset($_SESSION["name"]) ? $_SESSION["name"] : "";
	if (!$userid ){
		alert_back('board_modify_form error:29  로그인 후 이용해 주세요!');
		exit();
	}

	$num  = $_GET["num"];
	$page = $_GET["page"];
	$sql = "select * from board where num=$num";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($result);

	$name       = $row["name"];
	$subject    = $row["subject"];
	$content    = $row["content"];		
	$file_name  = $row["file_name"];
?>	
	    <form  name="board_modify_form" method="post" action="board_modify.php" enctype="multipart/form-data">
			<input type="hidden" name="num" value=<?=$num?>>
			<input type="hidden" name="page" value=<?=$page?>>
			<input type="hidden" name="file_name" value=<?=$file_name?>>
			<ul class="board_form">
				<li>
					<span class="column1">이름 : </span>
					<span class="column2"><?=$username?></span>
				</li>		
				<li>
					<span class="column1">제목 : </span>
					<span class="column2"><input name="subject" type="text" value="<?=$subject?>"></span>
				</li>	    	
				<li class="text_area">	
					<span class="column1">내용 : </span>
					<span class="column2">
						<textarea name="content"><?=$content?></textarea>
					</span>
				</li>
				<li>
					<span class="column1"> 파일 추가 : </span>
					<span class="column2"><input type="file" name="upfile"></span>
				</li>    		
<?php
				if($file_name){
?>
				<li>
					<span class="column1"> 첨부 파일 : </span>
					<span class="column2"><?=$file_name?></span>
					<input type="checkbox" class="column2" name="file_name" value="<?=$file_name?>">
				</li>
<?php
				}
?>				
	    	</ul>
	    	<ul class="buttons">
				<li><button type="button" onclick="check_inputmodify()">수정하기</button></li>
				<li><button type="button" onclick="location.href='board_list.php'">목록</button></li>
			</ul>
	    </form>
	</div> 
	</section> 
	<footer>
<?php 
        include "../main/footer.php"; 
?>
    </footer>
</body>
</html>
