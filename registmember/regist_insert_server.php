<?php
    include("../dbconnector/db_connect.php");

    $userid = $username = $pass1 = $pass2 = $email = $user_info ="";
    date_default_timezone_set('Asia/Seoul');
    $regist_day = date("Y-m-d (H:i)");
    
    if(isset($_POST['id']) && isset($_POST['name']) && isset($_POST['pass1']) && isset($_POST['pass2']) && isset($_POST['email'])){
        // mysql injection 함수 사용 php에서 제공하는 함수로 MYSQL과 커넥션을할때 String을 Escape한 상태로 만들어준다
		    // 우리가 string을 입력할때 Tom's cat 이란 입력을 하면  '는 sql문에 앞서 있던 ' 와 중첩이 될 수 있다.
		    // 이러한 문제를 막기위해 \n, \r \" 처럼 구별해주는 형태로 만들어주는 것을 Escape string 이라고 한다.
        $userid = mysqli_real_escape_string($con, $_POST['id']);
        $username = mysqli_real_escape_string($con, $_POST['name']);
        $pass1 = mysqli_real_escape_string($con, $_POST['pass1']);
        $pass2 = mysqli_real_escape_string($con, $_POST['pass2']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
    
        $user_info = "id={$userid}&name={$username}&pass1={$pass1}&pass2={$pass2}&email={$email}";
        if(empty($userid)){
            header("location: regist_form.php?error=아이디를 입력하세요&$user_info");
            exit();
          }else if(empty($username)){
            header("location: regist_form.php?error=이름을 입력하세요&$user_info");
            exit();
          }else if(empty($pass1)){
            header("location: regist_form.php?error=비밀번호를 입력하세요&$user_info");
            exit();
          }else if(empty($pass2)){
            header("location: regist_form.php?error=다시한번 비밀번호를 입력하세요&$user_info");
            exit();
          }else if($pass1 !== $pass2){
            header("location: regist_form.php?error=비밀번호가 일치하지 않습니다&$user_info");
            exit();
          }else if(empty($email)){
            header("location: regist_form.php?error=이메일을 작성해 주세요&$user_info");
            exit();
          }else {
         
            $pass1 = password_hash("$pass1", PASSWORD_DEFAULT);
        
            $sql_same = "select * from members where id = '$userid'";
            $record_set = mysqli_query($con,  $sql_same);
            // DB에 저장된 row데이터 개수를 알기 위한 방법으로 
            // select문으로 조건에 맞는 데이터를 조회한 후 해당하는 row데이터의 총 개수를 숫자로 반환
            if(mysqli_num_rows($record_set) == 1){
                header("location: regist_form.php?error=아이디가 존재합니다&$user_info");
                exit();
              }else{
        
                $sql_insert = "insert into members(id, pass, name, email, regist_day, level, point)";
                $sql_insert .= "values('$userid', '$pass1', '$username', '$email', '$regist_day', 1, 0)";
    
                $result = mysqli_query($con, $sql_insert);
                mysqli_close($con);
                if($result){
                    header("location: ../login/login_form.php?success=성공적으로 가입 되었습니다");
                    exit();
                  }else{
                    header("location: regist_form.php?error=regist_insert_server error:59 가입에 실패하였습니다&$user_info");
                    exit();          
                }
            }
        }
    }else {
        header("location: regist_form.php?error=regist_insert_server error:65 알수 없는 오류입니다&$user_info");
        exit(); 
    }
?>