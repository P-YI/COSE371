<?
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$inst_need = $_POST['inst_need'];
$requested_c = $_POST['requested_c'];
$matched_s = $_POST['matched_s'];

$result = mysqli_query($conn, "insert into session_request (date, inst_need, requested_c, matched_s) 
						values(NOW(), '$inst_need', '$requested_c', '$matched_s')");
if(!$result)
{
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 입력 되었습니다');
    echo "<script>location.replace('session_request_list.php');</script>";
}

?>
