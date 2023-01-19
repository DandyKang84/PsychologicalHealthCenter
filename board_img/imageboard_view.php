<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>이미지게시판</title>
    <link rel="stylesheet" type="text/css" href="../maincss/header.css?after">
    <link rel="stylesheet" type="text/css" href="../maincss/footer.css?after">
    <link rel="stylesheet" type="text/css" href="./css/form.css?after">
    <link rel="stylesheet" type="text/css" href="./css/ripple.css?after">
</head>

<body>
    <header>
<?php 
        include "../main/header_top.php";
        include "../main/header.php";
?>
    </header>
    <section>
    <div class="header_down_img">
    <img src="../img/counseling3.jpg" alt="">
    </div>
    <div class="imgboard_box">
        <h3 class="imgboard_title">이미지게시판 > 내용보기</h3>
        <ul id="board_list2">
<?php
        include("../dbconnector/db_connect.php");
        $userid = isset($_SESSION["id"]) ? $_SESSION["id"] : "";

        if (!$userid) {
            alert_back('imageboard_view error:32 로그인 후 이용해 주세요!');
            exit();
        }

        $num = $_GET["num"];
        $page = $_GET["page"];

        $sql = "select * from image_board where num=$num";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);

        $id = $row["id"];
        $name = $row["name"];
        $regist_day = $row["regist_day"];
        $subject = $row["subject"];
        $content = $row["content"];
        $file_name = $row["file_name"];
        $file_type = $row["file_type"];
        $file_copied = $row["file_copied"];
        $hit = $row["hit"];
        $content = str_replace(" ", "&nbsp;", $content);
        $content = str_replace("\n", "<br>", $content);

          // hit 추가 설정 조회수 : 이미지 게시판 몇명이 클릭했는지 점검
        if ($userid !== $id) {
            $new_hit = $hit + 1;
            $sql = "update image_board set hit=$new_hit where num=$num";
            mysqli_query($con, $sql);
        }

        $file_name = $row['file_name'];
        $file_copied = $row['file_copied'];
        $file_type = $row['file_type'];
        if (!empty($file_name)) {
            $image_info = getimagesize("../database/" . $file_copied);
            $image_width = $image_info[0];
            $image_height = $image_info[1];
            $image_type = $image_info[2];
            $image_width = 400;
            $image_height = 400;
            if ($image_width > 400) $image_width = 400;
        }
?>
        <ul id="view_content">
            <li>
            <span class="column1"><b>제목 :</b> <?= $subject ?></span>
            <span class="column2"><?= $name ?> | <?= $regist_day ?></span>
            </li>
            <li>
<?php
            if (strpos($file_type, "image") !== false) {
                echo "<img src='../database/$file_copied' width='$image_width'><br>";
            } else if ($file_name) {
                $real_name = $file_copied;
                $file_path = "../database/" . $real_name;
                $file_size = filesize($file_path);

                echo "▷ 첨부파일 : $file_name ($file_size Byte) &nbsp;&nbsp;&nbsp;&nbsp;
                <a href='board_download.php?real_name=$real_name&file_name=$file_name&file_type=$file_type'>[첨부파일 저장]</a><br><br>";
            }
?>
    <?= $content ?>
            </li>
        </ul>
        <div class="ripple">
            <div class="ripple1">댓글</div>
            <div class="ripple2">
<?php
            $sql = "select * from `image_board_ripple` where parent='$num' ";
            $ripple_result = mysqli_query($con, $sql);
            while ($ripple_row = mysqli_fetch_array($ripple_result)) {
                $ripple_num = $ripple_row['num'];
                $ripple_id = $ripple_row['id'];
                $ripple_nick = $ripple_row['nick'];
                $ripple_date = $ripple_row['regist_day'];
                $ripple_content = $ripple_row['content'];
                $ripple_content = str_replace("\n", "<br>", $ripple_content);
                $ripple_content = str_replace(" ", "&nbsp;", $ripple_content);
?>
        <div id="ripple_title">
            <ul>
                <li><?= $ripple_id . "&nbsp;&nbsp;" . $ripple_date ?></li>
                <li id="mdi_del">
<?php
                // 관리자모드이거나, 보모글을 쓴 유저라면 삭제기능 부여
                if ($_SESSION['id'] == "admin" || $_SESSION['id'] == $ripple_id) {
                    echo '
                    <form style="display:inline" action="imageboard_dui.php" method="post">
                    <input type="hidden" name="page" value="'.$page.'">
                    <input type="hidden" name="hit" value="' . $hit . '">
                    <input type="hidden" name="mode" value="delete_ripple">
                    <input type="hidden" name="num" value="' . $ripple_num . '">
                    <input type="hidden" name="parent" value="' . $num . '">
                    <span>' . $ripple_content . '</span>
                    <input type="submit" value="삭제">
                    </form>';
                }else{
                    echo '
                    <span>' . $ripple_content . '</span>';
                }
?>
                </li>
            </ul>
        </div>
<?php
        }
        mysqli_close($con);
?>
        <form name="ripple_form" action="imageboard_dui.php" method="post">
            <input type="hidden" name="mode" value="insert_ripple">
            <input type="hidden" name="parent" value="<?= $num ?>">
            <input type="hidden" name="hit" value="<?= $hit ?>">
            <input type="hidden" name="page" value="<?= $page ?>">
            <div class="ripple_insert">
                <div class="ripple_textarea"><textarea name="ripple_content" rows="3" cols="80" style="border: none"></textarea>
                </div>
                <div><button class="ripple_button">입력</button>
                </div>
            </div>
        </form>
        </div>
    </div>

    <div class="write_button">
        <ul class="buttons">
        <li>
            <button onclick="location.href='imageboard_list.php?page=<?= $page ?>'">목록</button>
        </li>
        <li>
            <form action="imageboard_modify_form.php" method="post">
            <button>수정</button>
            <input type="hidden" name="num" value=<?= $num ?>>
            <input type="hidden" name="page" value=<?= $page ?>>
            <input type="hidden" name="mode" value="modify">
            </form>
        </li>
        <li>
            <form action="imageboard_dui.php" method="post">
            <button>삭제</button>
            <input type="hidden" name="num" value=<?= $num ?>>
            <input type="hidden" name="page" value=<?= $page ?>>
            <input type="hidden" name="mode" value="delete">
            </form>
        </li>
        <li>
            <button onclick="location.href='imageboard_form.php'">글쓰기</button>
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