<?
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$sno = $_POST['sno'];
$sname = $_POST['sname'];
$sagency = $_POST['sagency'];
$sgenre = $_POST['sgenre'];
$major = $_POST['major'];
$phone = $_POST['phone'];
$recordno = $_POST['recordno'];

$result = mysqli_query($conn, "update session set sname = '$sname', sagency = '$sagency', 
						sgenre = '$sgenre', major = '$major', phone = '$phone', recordno = '$recordno' where sno = $sno");

if(!$result)
{
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 수정 되었습니다');
    echo "<script>location.replace('session_list.php');</script>";
}

?>

