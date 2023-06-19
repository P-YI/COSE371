<?
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$cno = $_GET['cno'];

$cid_ret = mysqli_query($conn, "select * from client inner join session_request on client.requestno = session_request.rno where cno = $cno");

if(!mysqli_fetch_array($cid_ret)){
    // 클라이언트가 세션 신청을 하지 않았을 경우에만 클라이언트를 삭제.
    $ret = mysqli_query($conn, "delete from client where cno = $cno");

    if(!$ret){
        msg('Query Error : '.mysqli_error($conn));
    }
    else{
        s_msg ('성공적으로 삭제 되었습니다');
        echo "<meta http-equiv='refresh' content='0;url=client_list.php'>";
    }    
}
else{
    // 세션을 신청한 클라이언트는 삭제할 수 없음.
    s_msg ('이미 세션 신청을 한 고객이므로 삭제할 수 없습니다.');
    echo "<meta http-equiv='refresh' content='0;url=client_list.php'>";
}

?>