<?php
    include("../dbconnector/db_connect.php");
    session_start();

    $userid = $pass1 = $user_info ="";
    if(isset($_POST['id']) && isset($_POST['pass1'])){
        // mysql injection 함수 사용 php에서 제공하는 함수로 MYSQL과 커넥션을할때 String을 Escape한 상태로 만들어준다
		// 우리가 string을 입력할때 Tom's cat 이란 입력을 하면  '는 sql문에 앞서 있던 ' 와 중첩이 될 수 있다.
		// 이러한 문제를 막기위해 \n, \r \" 처럼 구별해주는 형태로 만들어주는 것을 Escape string 이라고 한다.
        $userid = mysqli_real_escape_string($con, $_POST['id']);
        $pass1 = mysqli_real_escape_string($con, $_POST['pass1']);
    
        $user_info = "id={$userid}&pass1={$pass1}";
        if(empty($userid)){
            header("location: login_form.php?error=아이디를 입력하세요&$user_info");
            exit();
        }else if(empty($pass1)){
            header("location: login_form.php?error=비밀번호를 입력하세요&$user_info");
            exit();
        }else {
            $sql_same = "select * from members where id = '$userid' ";
            $record_set = mysqli_query($con,  $sql_same);
    
            if (mysqli_num_rows($record_set) == 1) {
                $row = mysqli_fetch_array($record_set);
                $hash_value = $row["pass"];

                if (password_verify($pass1, $hash_value)) {   
                    $_SESSION["id"] = $row["id"];
                    $_SESSION["pass"] = $row["pass"];
                    $_SESSION["name"] = $row["name"];
                    $_SESSION["email"] = $row["email"];
                    $_SESSION["level"] = $row["level"];
                    $_SESSION["point"] = $row["point"];
            
                    header('location:http://'.$_SERVER['HTTP_HOST'].'/myhomepage/index.php');
                    exit();
                } else {
                    header("location:login_form.php?error=비밀번호가 틀렸습니다&$user_info");
                    exit();
                }
            } else {
                header("location:login_form.php?error=해당 아이디를 찾을 수 없습니다&$user_info");
                exit();
            }
        }

    }else {
        header("location: login_form.php?error=login_server error:49 알수 없는 오류입니다");
        exit();

    }


?>

