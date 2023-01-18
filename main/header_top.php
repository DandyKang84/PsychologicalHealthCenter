<?php
    session_start();
    $userid = isset($_SESSION["id"]) ? $_SESSION["id"] : "";
    $username = isset($_SESSION["name"]) ? $_SESSION["name"] : "";
    $level = isset($_SESSION["level"]) ? $_SESSION["level"] : "";
    $point = isset($_SESSION["point"]) ? $_SESSION["point"] : ""; 
    $page = isset($_GET["page"]) ? $_GET["page"] : 1;
?>

<div class="header_top">
    <!-- top menu -->
    <div class="header_top_menu">
        <ul class="header_top_menu_content">
<?php
            if(!$userid) {
?>
                <li><a href="http://<?=$_SERVER['HTTP_HOST'];?>/myhomepage/login/login_form.php">로그인</a> </li>
                <li><a href="http://<?=$_SERVER['HTTP_HOST'];?>/myhomepage/registmember/regist_form.php">회원가입</a></li>
               
<?php
            } else {
                $logged = "{$username} . ({$userid})님 [ Point : {$point} ]";
?>
                <li><?=$logged?> </li>
                <li><a href="http://<?=$_SERVER['HTTP_HOST'];?>/myhomepage/login/logout.php">로그아웃</a> </li>
                <li><a href="http://<?=$_SERVER['HTTP_HOST'];?>/myhomepage/registmember/regist_modify_form.php">회원정보 수정</a></li>
<?php
            }
?>
<?php
            if($level==1) {
                ?>
                <li>|</li>
                <li><a href="http://<?=$_SERVER['HTTP_HOST'];?>/myhomepage/admin/admin_form.php">관리자 모드</a></li>
                <?php
            }
        ?>
        </ul>
        <ul class="header_top_menu_icon">
        <li><a href="https://www.instagram.com/___warm_hearted"><i class="fab fa-instagram"></i></a></li>
            <li><a href="https://www.facebook.com/hugmomhugin"><i class="fab fa-facebook-square"></i></a></li>
            <li><a href="https://twitter.com/hellosmile2012"><i class="fa-brands fa-twitter"></i></a></li>
        </ul>

    </div>
</div>