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
        <img src="../img/header_main1.png" alt="">
    </div> 
	<section>
   	<div class="board_box">
	    <h3>게시판 > 목록보기</h3>
	    <ul class="board_list">
			<li>
				<span class="column1">번호</span>
				<span class="column2">제목</span>
				<span class="column3">글쓴이</span>
				<span class="column4">첨부</span>
				<span class="column5">등록일</span>
				<span class="column6">조회</span>
			</li>
<?php
	include("../dbconnector/db_connect.php");

	// 페이지 설정되어 있지 않으면 기본 디폴트값으로 1로 설정한다.
	$page = isset($_GET["page"]) ? $_GET["page"] : 1;
	// 전체 레코드수
	$sql = "select * from board order by num desc";
	$result = mysqli_query($con, $sql);
	$total_record = mysqli_num_rows($result); 
	$scale = 5;
	// 전체 페이지 수($total_page) 계산
	$total_page = ceil($total_record / $scale);
	// 표시할 페이지($page)에 따라 $start 계산 예)6페이지 (50번~59번)
	$start = ($page - 1) * $scale;

	$sql = "select * from board order by num desc LIMIT $start, $scale";
	$result = mysqli_query($con, $sql);

	if ($total_record % $scale == 0) {
		$total_page = floor($total_record/$scale); 
	}else{
		$total_page = floor($total_record/$scale) + 1; 
	}    
	$number = $total_record - $start;

	while($row = mysqli_fetch_array($result)){
		$num = $row["num"];
		$userid = $row["id"];
		$username = $row["name"];
		$subject = $row["subject"];
		$regist_day = $row["regist_day"];
		$hit = $row["hit"];

		if ($row["file_name"]){
			$file_image = "<img src='./img/file.gif'>";
		}else{
			$file_image = " ";
	}
?>
			<li class="board_list_li">
				<span class="column1"><?=$number?></span>
				<span class="column2"><a href="board_view.php?num=<?=$num?>&page=<?=$page?>"><?=$subject?></a></span>
				<span class="column3"><?=$username?></span>
				<span class="column4"><?=$file_image?></span>
				<span class="column5"><?=$regist_day?></span>
				<span class="column6"><?=$hit?></span>
			</li>	
<?php
   	   $number--;
   }
   mysqli_close($con);
?>
		</ul>
		<ul class="page_num"> 	
<?php
		$url = 'board_list.php?';
		get_paging2($scale, $page, $total_page, $url);
?>
		</ul>    	
		<ul class="buttons">
			<li><button onclick="location.href='board_list.php'">목록</button></li>
			<li>
<?php 
			if($userid) {
?>
			<button onclick="location.href='board_form.php'">글쓰기</button>
<?php
			} else {
?>
			<a href="javascript:alert('board_list error:102 로그인 후 이용해 주세요!')"><button>글쓰기</button></a>
<?php
			}
?>
			</li>
		</ul>
	</div> 
	</section> 
	<footer>
<?php 
        include "../main/footer.php"; 
?>
    </footer>
</body>
</html>
