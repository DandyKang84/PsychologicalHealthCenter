<?php
    session_start();
    $userid = isset($_SESSION["id"]) ? $_SESSION["id"] : "";
    $username = isset($_SESSION["name"]) ? $_SESSION["name"] : "";
    if (!$userid ){
        alert_back('board_download error:6 로그인 후 이용해 주세요!');
        exit();
    }

    $real_name = $_GET["real_name"];
    $file_name = $_GET["file_name"];
    $file_type = $_GET["file_type"];
    $file_path = "../database/".$real_name;

    // $_SERVER['HTTP_USER_AGENT'] : 웹브라우저 정보 가져옴
    // preg_match(data,target) : target에서 data정보를 찾아라
    $ie = preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) || 
        (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0') !== false && 
            strpos($_SERVER['HTTP_USER_AGENT'], 'rv:11.0') !== false);

    //IE인경우 한글파일명이 깨지는 경우를 방지하기 위한 코드 
    //iconv('utf-8', 'euc-kr', $file_name): $file_name 의 utf-8문자셋을 euc-kr 문자셋으로 변경함
    if( $ie ){
         $file_name = iconv('utf-8', 'euc-kr', $file_name);
    }
    // file_exists($file_path) 해당되는 파일이 존재하는지 유무 체크
    if(file_exists($file_path) ){ 
        // rb 비트단위로 받겠다
		$fp = fopen($file_path,"rb");
        // 다운로드할 파일의 정보를 Header() 함수로 클라이언트 브라우저에게 알려줌
		Header("Content-type: application/x-msdownload"); 
        Header("Content-Length: ".filesize($file_path));     
        Header("Content-Disposition: attachment; filename=".$file_name);
        // Encoding 통신기능을 위한 암호화
        Header("Content-Transfer-Encoding: binary"); 
		Header("Content-Description: File Transfer"); 
        Header("Expires: 0");       
    } 
	//fpassthru($fp) 함수는  현재 파일 포인터가 지시하는 위치부터 끝까지 파일을
    //읽어 출력버퍼에 저장한다. 이렇게 함으로써 사용자의 컴퓨터로 파일이 전송된다. 
    //성공: 전송된 문자의 개수 변환, 실패하면:  false
    //fclose($fp) : 파일 포인터가 지시하는 파일을 닫는다.  성공: true, 실패: false
    if(!fpassthru($fp)) {
        fclose($fp); 
    }else{
        fclose($fp); 
    }

?>

  
