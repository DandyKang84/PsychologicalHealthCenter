
<?php
    include("../dbconnector/db_connect.php");
    
    $message = $userid = "";
    if(isset($_GET['id'])){
    // mysql injection 함수 사용 php에서 제공하는 함수로 MYSQL과 커넥션을할때 String을 Escape한 상태로 만들어준다
    // 우리가 string을 입력할때 Tom's cat 이란 입력을 하면  '는 sql문에 앞서 있던 ' 와 중첩이 될 수 있다.
    // 이러한 문제를 막기위해 \n, \r \" 처럼 구별해주는 형태로 만들어주는 것을 Escape string 이라고 한다.
    $userid = mysqli_real_escape_string($con, $_GET['id']);

    if(empty($userid)){
        $message = "아이디 작성 부탁드립니다";  
    }else {
        $sql_same = "select * from members where id = '$userid'";
        $record_set = mysqli_query($con,  $sql_same);
        // DB에 저장된 row데이터 개수를 알기 위한 방법으로 
    // select문으로 조건에 맞는 데이터를 조회한 후 해당하는 row데이터의 총 개수를 숫자로 반환
        if(mysqli_num_rows($record_set) > 0){
            $message = "[{$userid}]의 아이디는 사용불가 입니다.";
          }else{
            $message = "[{$userid}]의 아이디는 사용가능 합니다.";
        }
    }
    mysqli_close($con);
}
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="./css/registmember.css?after">
</head>
<body>
    <h3 class="id_check_h3">아이디 중복체크</h3>
    <p class="id_check_window">
<?php
        echo $message;
?>
</p>
    <div id="close">
        <button class="save_button" type="button" onclick="javascript:self.close()">저장</button>
        <button class="close_button" type="button" onclick="javascript:self.close()">취소</button>
    </div>
</body>
</html>

