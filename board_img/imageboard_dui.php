<?php
	session_start();
    include("../dbconnector/db_connect.php");
    date_default_timezone_set('Asia/Seoul');
    $userid = isset($_SESSION["id"]) ? $_SESSION["id"] : "";
    $username = isset($_SESSION["name"]) ? $_SESSION["name"] : "";
	if (!$userid ){
        alert_back('imageboard_dui error:08 로그인 후 이용해 주세요!');
        exit();
	}

    if (isset($_POST["mode"]) && $_POST["mode"] === "delete") {
        $num = $_POST["num"];
        $page = $_POST["page"];
        $sql = "select * from image_board where num = $num";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);
        $writer = $row["id"];
        $copied_name = $row["file_copied"];

        if (!isset($userid) || ($userid == $writer && $level == '1')) {
            alert_back('imageboard_dui error:22 수정권한이 없습니다.');
            exit();
        }
        if ($copied_name) {
            $file_path = "../database/" . $copied_name;
            unlink($file_path);
        }

        $sql = "delete from image_board where num = $num";
        mysqli_query($con, $sql);

        $sql = "delete from image_board_ripple where parent = $num";
        mysqli_query($con, $sql);
        mysqli_close($con);

        echo "
	     <script>
	         location.href = 'imageboard_list.php?page=$page';
	     </script>
	   ";
    } else if (isset($_POST["mode"]) && $_POST["mode"] === "insert") {
        if (!$userid) {
            alert_back('imageboard_dui error:44 게시판 글쓰기는 로그인 후 이용바랍니다.');
            exit();
        }

        $subject = $_POST["subject"];
        $content = $_POST["content"];
        // //공백제거, 슬래쉬제거, 특수문자타입 변경하기
        $subject = input_set($subject);
        $content = input_set($content);

        $regist_day = date("Y-m-d (H:i)");
        $upload_dir = "../database/";
        // 파일배열에서 5개 항목을 받는다.
        $upfile_name = $_FILES["upfile"]["name"];
        $upfile_tmp_name = $_FILES["upfile"]["tmp_name"];
        $upfile_type = $_FILES["upfile"]["type"];
        // 안되면 php ini에서 최대 크기 수정!
        $upfile_size = $_FILES["upfile"]["size"]; 
        $upfile_error = $_FILES["upfile"]["error"];

        if ($upfile_name && !$upfile_error) { 
            // 파일을 파일명과 확장자를 분리시킨다.(memo.sql) => ['memo','sql']
            $file = explode(".", $upfile_name); 
            $file_name = $file[0]; 
            $file_ext = $file[1]; 
            //3. 서버에 저장할 파일명을 중복되지 않기 하기위해서 날짜명_시간_파일명.확장자 만든다.
            $new_file_name = date("Y_m_d_H_i_s");
            $new_file_name = $new_file_name . "_" . $file_name;
            $copied_file_name = $new_file_name . "." . $file_ext; 
            // ./data/2023_01_11_11_11_11_memo.sql 다 합친것 
            $uploaded_file = $upload_dir . $copied_file_name; 

            if ($upfile_size > 100000000) {
                alert_back('업로드 파일 크기가 지정된 용량(100MB)을 초과합니다!<br>파일 크기를 체크해주세요!');
                exit();
            }
            if (!move_uploaded_file($upfile_tmp_name, $uploaded_file)) {
            header("location: imageboard_dui.php?error= imageboard_dui error:81 업로드 실패했습니다.");
            exit(); 
            }
        } else {
            $upfile_name = "";
            $upfile_type = "";
            $copied_file_name = "";
        }

        $sql = "insert into image_board (id, name, subject, content, regist_day, hit,  file_name, file_type, file_copied) ";
        $sql .= "values('$userid', '$username', '$subject', '$content', '$regist_day', 0, ";
        $sql .= "'$upfile_name', '$upfile_type', '$copied_file_name')";
        mysqli_query($con, $sql);

        // 포인트 부여하기
        $point_up = 100;
        $sql = "select point from members where id='$userid'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);
        $new_point = $row["point"] + $point_up;

        $sql = "update members set point=$new_point where id='$userid'";
        mysqli_query($con, $sql);
        mysqli_close($con); 

        echo "
	   <script>
	    location.href = 'imageboard_list.php';
	   </script>
	    ";

    } else if (isset($_POST["mode"]) && $_POST["mode"] === "modify") {
        $num = $_POST["num"];
        $page = $_POST["page"];

        $subject = $_POST["subject"];
        $content = $_POST["content"];
        $file_delete = (isset($_POST["file_delete"])) ? $_POST["file_delete"] : 'no';

        $sql = "select * from image_board where num = $num";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);

        $copied_name = $row["file_copied"];
        $upfile_name = $row["file_name"];
        $upfile_type = $row["file_type"];
        $copied_file_name = $row["file_copied"];
        //제목하고 내용만 수정, 기존의파일만 제거
        if (($file_delete !== "yes") && empty($_FILES["upfile"]["name"])) {
            $sql = "update image_board set subject = '$subject', content = '$content' where num = $num";
            mysqli_query($con, $sql);
        }else if(($file_delete === "yes") && empty($_FILES["upfile"]["name"])){
            if ($copied_name) {
                $file_path = "../database/" . $copied_name;
                unlink($file_path);
            }
            $upfile_name = "";
            $upfile_type = "";
            $copied_file_name = "";
            $sql = "update image_board set subject = '$subject', content = '$content' where num = $num";
            mysqli_query($con, $sql);
        } else {
            if ($copied_name) {
                $file_path = "../database/" . $copied_name;
                unlink($file_path);
            }
            $upfile_name = "";
            $upfile_type = "";
            $copied_file_name = "";

            if (isset($_FILES['upfile'])) {
            $upload_dir = "../database/";
            // 파일배열에서 5개 항목을 받는다.
            $upfile_name = $_FILES["upfile"]["name"];
            $upfile_tmp_name = $_FILES["upfile"]["tmp_name"];
            $upfile_type = $_FILES["upfile"]["type"];
            // 안되면 php ini에서 최대 크기 수정!
            $upfile_size = $_FILES["upfile"]["size"];
            $upfile_error = $_FILES["upfile"]["error"];

            if ($upfile_name && !$upfile_error) { 
                // 파일을 파일명과 확장자를 분리시킨다.(memo.sql) => ['memo','sql']
                $file = explode(".", $upfile_name); 
                $file_name = $file[0]; 
                $file_ext = $file[1]; 
                // 서버에 저장할 파일명을 중복되지 않기 하기위해서 날짜명_시간_파일명.확장자 만든다.
                $new_file_name = date("Y_m_d_H_i_s");
                $new_file_name = $new_file_name . "_" . $file_name;
                $copied_file_name = $new_file_name . "." . $file_ext;
                // ./data/2023_01_11_11_11_11_memo.sql 다 합친것
                $uploaded_file = $upload_dir . $copied_file_name; 

                if ($upfile_size > 100000000) {
                    alert_back('imageboard_dui error:174 업로드 파일 크기가 지정된 용량(100MB)을 초과합니다!<br>파일 크기를 체크해주세요!');
                    exit();
                }

                if (!move_uploaded_file($upfile_tmp_name, $uploaded_file)) {
                    alert_back('error=imageboard_dui error:179 파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
                    exit();
                }
            } 
            $sql_update = "update image_board set subject = '$subject', content = '$content', file_name = '$upfile_name', file_type = '$upfile_type', file_copied = '$copied_file_name' where num = $num";
            mysqli_query($con, $sql);
            }
        }
        echo "
	      <script>
	          location.href = 'imageboard_list.php?page=$page';
	      </script>
	    ";
    } else if (isset($_POST["mode"]) && $_POST["mode"] == "insert_ripple") {
        if (empty($_POST["ripple_content"])) {
            alert_back('imageboard_dui error:194 내용을 입력해 주세요!');
            exit();
        }
        // mysql injection 함수 사용 php에서 제공하는 함수로 MYSQL과 커넥션을할때 String을 Escape한 상태로 만들어준다
		// 우리가 string을 입력할때 Tom's cat 이란 입력을 하면  '는 sql문에 앞서 있던 ' 와 중첩이 될 수 있다.
		// 이러한 문제를 막기위해 \n, \r \" 처럼 구별해주는 형태로 만들어주는 것을 Escape string 이라고 한다.
        $q_userid = mysqli_real_escape_string($con, $userid);
        $sql = "select * from members where id = '$q_userid'";
        $result = mysqli_query($con, $sql);
        if (!$result) {
            die('Error: ' . mysqli_error($con));
        }
        $rowcount = mysqli_num_rows($result);

        if (!$rowcount) {
            alert_back('imageboard_dui error:207 아이디를 찾을 수 없습니다.');
            exit();
        } else {
            //공백제거, 슬래쉬제거, 특수문자타입 변경하기
            $content = input_set($_POST["ripple_content"]);
            $page = input_set($_POST["page"]);
            $parent = input_set($_POST["parent"]);
            $hit = input_set($_POST["hit"]);
            
            $q_usernick = isset($_SESSION['nick']) ? mysqli_real_escape_string($con, $_SESSION['nick']) : null;
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
            echo "<script>location.href='./imageboard_view.php?num=$parent&page=$page&hit=$hit';</script>";
        }
    } else if (isset($_POST["mode"]) && $_POST["mode"] == "delete_ripple") {
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
        echo "<script>location.href='./imageboard_view.php?num=$parent&page=$page&hit=$hit';</script>";
    }

?>

