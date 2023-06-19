<?
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$sno = $_GET['sno'];

$sid_ret = mysqli_query($conn, "select * from session inner join record_manage on session.recordno = record_manage.mno where sno = $sno");

if(!mysqli_fetch_array($sid_ret)){
    
    $ret = mysqli_query($conn, "delete from session where sno = $sno");

    if(!$ret){
        msg('Query Error : '.mysqli_error($conn));
    }
    else{
        s_msg ('성공적으로 삭제 되었습니다');
        echo "<meta http-equiv='refresh' content='0;url=session_list.php'>";
    }    
}
else{
    
    s_msg ('이미 녹음 참여를 결정한 세션이므로 삭제할 수 없습니다.');
    echo "<meta http-equiv='refresh' content='0;url=session_list.php'>";
}

?>

