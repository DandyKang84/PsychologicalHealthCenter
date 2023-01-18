<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>이미지게시판</title>
    <link rel="stylesheet" type="text/css" href="../maincss/header.css?after">
    <link rel="stylesheet" type="text/css" href="../maincss/footer.css?after">
    <link rel="stylesheet" type="text/css" href="./css/list.css?after">
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

    <div class="imgboard_box">
        <h3>이미지게시판 > 목록보기</h3>
        <ul class="imgboard_list">
<?php
    include("../dbconnector/db_connect.php");
    $page = isset($_GET["page"]) ? $_GET["page"] : 1;
    $sql = "select count(*) from image_board order by num desc";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $total_record = intval($row[0]);

    $scale = 5;
    // ceil() 함수는 소수점 자리의 숫자를 무조건 올리는 함수이다. 
    // 실수(float)을 정수(integer)로 만든다.
    $total_page = ceil($total_record / $scale);

    $start = ($page - 1) * $scale;
    $number = $total_record - $start;

    $list = array();
    $sql = "select * from image_board order by num desc LIMIT $start, $scale";
    $result = mysqli_query($con, $sql);
    $i = 0;
    while($row = mysqli_fetch_array($result)){
        $list[$i] = $row;
        $list_num = $total_record - ($page - 1) * $scale;
        $list[$i]['no'] = $list_num - $i;
        $i++;
    }
    // 화면에 보여질 이미지 사이즈 제한
    $image_width = 200;
    $image_height = 300;

    for($i=0; $i<count($list); $i++){

        $file_image = (!empty($list[$i]['file_name'])) ? "<img src='./img/file.gif'>" : " ";
        $date = substr($list[$i]['regist_day'], 0, 10);

        if (!empty($list[$i]['file_name'])) {
            $image_info = getimagesize("../database/".$list[$i]['file_copied']);
            $image_width = $image_info[0];
            $image_height + $image_info[1];
            $imge_type = $image_info[2];
            if($image_width > 200){
                $image_width = 200;
            }
            if($image_height > 300){
                $image_height = 300;
            }
            $file_copied = $list[$i]['file_copied'];
        }
?>
        <li>
            <span>
                <a href="imageboard_view.php?num=<?= $list[$i]['num'] ?>&page=<?= $page ?>">
<?php      
                if(strpos($list[$i]['file_type'],"image") !== false){
                    
                    echo "
                    <img src='../database/$file_copied' width='$image_width' height='$image_height'><br>
                    ";
                }else {
                    echo "
                    <img src='../database/defalut.png' width='$image_width' height='$image_height'><br>
                    ";
                }
?>
                <?= $list[$i]['subject']?></a><br>
                <?= $list[$i]['id']?><br>
                <?= $date?>
            </span>
        </li>
<?php
        }
        mysqli_close($con);
?>
        </ul>
        <ul class="page_num">
<?php
        $url = "imageboard_list.php?";
        echo get_paging2($scale, $page, $total_page, $url);
?>
        </ul>
        <ul class="buttons">
            <li>
                <button class="btn_register1"  onclick="location.href='imageboard_list.php'">목록</button>
            </li>
            <li>
<?php
        if($userid){
?>
            <button class="btn_register2" onclick="location.href='imageboard_form.php'">글쓰기</button>
<?php
        }else {
?>
            <a href="javascript:alert('imageboard_list error:117 로그인 후 이용 바랍니다.')"><button class="btn_register2" >글쓰기</button></a>
<?php
        }
?>
            </li>
        </ul>
    </section>
    </div>
	<footer>
<?php 
        include "../main/footer.php"; 
?>
    </footer>
</body>
</html>