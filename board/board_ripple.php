<?php    
	session_start();
    include("../dbconnector/db_connect.php");
    date_default_timezone_set('Asia/Seoul');
    $userid = isset($_SESSION["id"]) ? $_SESSION["id"] : "";
    $username = isset($_SESSION["name"]) ? $_SESSION["name"] : "";
	if (!$userid ){
        alert_back('board_ripple error:08 로그인 후 이용해 주세요!');
        exit();
	}
    if (isset($_POST["mode"]) && $_POST["mode"] == "insert_ripple") {
        if (empty($_POST["ripple_content"])) {
            alert_back('board_ripple error:13 내용을 입력해 주세요!');
            exit();
        }
    }
    $q_userid = mysqli_real_escape_string($con, $userid);
    $sql = "select * from members where id = '$q_userid'";
    $result = mysqli_query($con, $sql);
    if (!$result) {
        die('Error: ' . mysqli_error($con));
    }
    $rowcount = mysqli_num_rows($result);

    if (!$rowcount) {
        alert_back('board_ripple error:26 로그인 후 이용해 주세요!');
        exit();
    } else {
        // htmlspecialchars 이 함수는 문자열에서 특정한 특수 문자를 HTML 엔티티로 변환한다. 이함수를 사용하면 악성 사용자로 부터 XSS 공격을 방지 할 수 있다
        $content = input_set($_POST["ripple_content"]);
        $page = input_set($_POST["page"]);
        $parent = input_set($_POST["parent"]);
        $hit = input_set($_POST["hit"]);
        $q_usernick = isset($_SESSION['nick']) ? mysqli_real_escape_string($con, $_SESSION['nick']) : null;
        // mysql injection 함수 사용 php에서 제공하는 함수로 MYSQL과 커넥션을할때 String을 Escape한 상태로 만들어준다
		// 우리가 string을 입력할때 Tom's cat 이란 입력을 하면  '는 sql문에 앞서 있던 ' 와 중첩이 될 수 있다.
		// 이러한 문제를 막기위해 \n, \r \" 처럼 구별해주는 형태로 만들어주는 것을 Escape string 이라고 한다.
        $q_username = mysqli_real_escape_string($con, $_SESSION['name']);
        $q_content = mysqli_real_escape_string($con, $content);
        $q_parent = mysqli_real_escape_string($con, $parent);
        $regist_day = date("Y-m-d (H:i)");

        $sql = "INSERT INTO `image_board_ripple` VALUES (null,'$q_parent','$q_userid','$q_username', '$q_usernick','$q_content','$regist_day')";
        $result = mysqli_query($con, $sql);
        if (!$result) {
            die('Error: ' . mysqli_error($con));
        }
        mysqli_close($con);
        echo "
        <script>
            location.href='./board_view.php?num=$parent&page=$page&hit=$hit';
        </script>
        ";
    }
    if (isset($_POST["mode"]) && $_POST["mode"] == "delete_ripple") {
        $page = input_set($_POST["page"]);
        $hit = input_set($_POST["hit"]);
        $num = input_set($_POST["num"]);
        $parent = input_set($_POST["parent"]);
        $q_num = mysqli_real_escape_string($con, $num);

        $sql = "DELETE FROM `image_board_ripple` WHERE num=$q_num";
        $result = mysqli_query($con, $sql);
        if (!$result) {
            die('Error: ' . mysqli_error($con));
        }
        mysqli_close($con);
        echo "
        <script>
            location.href='./board_view.php?num=$parent&page=$page&hit=$hit';</script>";
    }
?>