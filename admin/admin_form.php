<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>관리자모드</title>
	<link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/myhomepage/maincss/header.css?after">
    <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/myhomepage/maincss/footer.css?after">
	<link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/myhomepage/admin/css/admin.css">
</head>
<body> 
	<header>
<?php 
        include $_SERVER['DOCUMENT_ROOT'] . "/myhomepage/main/header_top.php";
        include $_SERVER['DOCUMENT_ROOT'] . "/myhomepage/main/header.php";
?>
    </header> 

    <section>
        <div class="admin_box">
            <h3 class="member_title">관리자 모드 > 회원 관리</h3>
            <ul class="member_list">
                <li>
                    <span class="column1">번호</span>
                    <span class="column2">아이디</span>
                    <span class="column3">이름</span>
                    <span class="column4">레벨</span>
                    <span class="column5">포인트</span>
                    <span class="column6">가입일</span>
                    <span class="column7">수정</span>
                    <span class="column8">삭제</span>
                </li>
<?php
                 include_once $_SERVER['DOCUMENT_ROOT'] . "/myhomepage/dbconnector/db_connect.php";

                $sql = "select * from members order by num desc";
                $result = mysqli_query($con, $sql);
                $total_record = mysqli_num_rows($result); // 전체 회원 수
                $number = $total_record;

                while ($row = mysqli_fetch_array($result)) {
                    $num = $row['num'];
                    $id = $row['id'];
                    $name = $row['name'];
                    $level = $row['level'];
                    $point = $row['point'];
                    $regist_day = $row['regist_day'];
?>
                <li>
                    <form
                        action="http://<?= $_SERVER['HTTP_HOST']; ?>/myhomepage/admin/admin_member_crud.php?mode=update"
                        method="post">
                        <input type="hidden" name="num" value="<?= $num ?>">
                        <span class="column1"><?= $number ?></span>
                        <span class="column2"><?= $id ?></span>
                        <span class="column3"><?= $name ?></span>
                        <span class="column4"><input type="text" name="level" value="<?= $level ?>"></span>
                        <span class="column5"><input type="text" name="point" value="<?= $point ?>"></span>
                        <span class="column6"><?= $regist_day ?></span>
                        <span class="column7"><button type="submit">수정</button></span>
                        <span class="column8"><button type="button"
                                onclick="location.href='admin_member_crud.php?mode=delete&num=<?= $num ?>'">삭제</button></span>
                    </form>
                </li>
<?php
                    $number--;
                }
?>
            </ul>
            <h3 class="member_title">관리자 모드 > 게시판 관리</h3>
            <ul class="board_list">
                <li class="title">
                    <span class="column1">선택</span>
                    <span class="column2">번호</span>
                    <span class="column3">이름</span>
                    <span class="column4">제목</span>
                    <span class="column5">첨부파일명</span>
                    <span class="column6">작성일</span>
                </li>
                <form method="post" action="admin_member_crud.php?mode=board_delete">
<?php
                    $sql = "select * from board order by num desc";
                    $result = mysqli_query($con, $sql);
                    $total_record = mysqli_num_rows($result); // 전체 글 수
                    $number = $total_record;

                    while ($row = mysqli_fetch_array($result)) {
                        $num = $row['num'];
                        $name = $row['name'];
                        $subject = $row['subject'];
                        $file_name = $row['file_name'];
                        $regist_day = $row['regist_day'];
                        $regist_day = substr($regist_day, 0, 10);
?>
                    <li>
                        <span class="column1"><input type="checkbox" name="item[]" value="<?= $num ?>"></span>
                        <span class="column2"><?= $number ?></span>
                        <span class="column3"><?= $name ?></span>
                        <span class="column4"><?= $subject ?></span>
                        <span class="column5"><?= $file_name ?></span>
                        <span class="column6"><?= $regist_day ?></span>
                    </li>
<?php
                        $number--;
                    }
                    mysqli_close($con);
?>
                    <span id="column9"><button type="submit">선택된 글 삭제</button></span>
                </form>
            </ul>
        </div>
    </section>
	<footer>
<?php 
        include $_SERVER['DOCUMENT_ROOT'] . "/myhomepage/main/footer.php"; 
?>
    </footer>
</body>

</html>