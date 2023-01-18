<?php
$con = mysqli_connect("localhost", "root", "123456", "mycounselingdb") or die("접속실패");


function alert_back($message){
    echo("
        <script>
        alert('$message');
        history.go(-1)
        </script>
        ");
}

 //공백제거, 슬래쉬제거, 특수문자타입 변경하기
function input_set($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>