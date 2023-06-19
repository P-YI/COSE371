<?
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$rno = $_POST['rno'];
$inst_need = $_POST['inst_need'];
$requested_c = $_POST['requested_c'];
$matched_s = $_POST['matched_s'];

$result = mysqli_query($conn, "update session_request set date = NOW(), inst_need = '$inst_need', 
						requested_c = '$requested_c', matched_s = '$matched_s'  where rno = $rno");

if(!$result)
{
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 수정 되었습니다');
    echo "<script>location.replace('session_request_list.php');</script>";
}

?>

