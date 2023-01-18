<?php
function create_table($con,$table_name){

// table check
$flag = false;
$sql = "show tables from mycounselingdb";
$result = mysqli_query($con, $sql) or die ("테이블 보여주기 실패". mysqli_connent_error());
while($row = mysqli_fetch_array($result)){
    if($row[0] == "$table_name"){
        $flag = true;
        break;
    }
}

// 원하는 테이블이 없다면
if($flag == false){
    switch($table_name){
        // 회원테이블
        case 'members' :
            $sql = "CREATE TABLE if not exists `members` ( 
                num int not null auto_increment,
                  id char(15) not null,
                  pass varchar(255) not null,
                  name char(10) not null,
                  email char(80),
                  regist_day char(20),
                  level int,
                  point int,
                  primary key(num) 
              ) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;";
              break;
        //게시판테이블
        case 'board' :
            $sql = "CREATE TABLE if not exists `board` (
                num int not null auto_increment,
                id char(15) not null,
                name char(10) not null,
                subject char(200) not null,
                content text not null,        
                regist_day char(20) not null,
                hit int not null,
                file_name char(40),
                file_type char(40),
                file_copied char(40),
                primary key(num)
                ) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;";
            break;
         //쪽지보내기 테이블
        case 'message' :
            $sql = "CREATE TABLE if not exists `message` (
                num int not null auto_increment,
                send_id char(20) not null,
                rv_id char(20) not null,
                subject char(200) not null,
                content text not null, 
                regist_day char(20),
                primary key(num)
                ) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;";
            break;
        case 'image_board':
            $sql = "CREATE TABLE `image_board` (
                num int not null AUTO_INCREMENT,
                id char(15) not null,
                name char(10) not null,
                subject char(200) not null,
                content text not null,
                regist_day char(20) not null,
                hit int not null, 
                file_name char(40) not null,
                file_type char(40) not null,
                file_copied char(40) not null,
                PRIMARY KEY (num),
                KEY id (id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
                break;      
        //이미지 게시판 답변 테이블
        case 'image_board_ripple':
            $sql = "CREATE TABLE `image_board_ripple` (
                num int(11) not null AUTO_INCREMENT,
                parent int(11) not null,
                id char(15) not null,
                name char(10) not null,
                nick char(10) not null,
                content text not null,
                regist_day char(20) DEFAULT NULL,
                PRIMARY KEY (num),
                KEY regist_day (regist_day)
            ) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;";
                break;
        default:
            echo "<script>alert('해당테이블을 찾을 수 없습니다..')</script>";
            break;

    }
   
    $result = mysqli_query($con, $sql) or die("데이타베이스 생성 실패". mysqli_connent_error());
    if($result == true){
        echo "<script>alert('{$table_name}테이블이 생성되었습니다.')</script>";
    }else {
        echo "<script>alert('{$table_name}테이블이 생성되지 않았습니다.')</script>";
    }
}
}
?>