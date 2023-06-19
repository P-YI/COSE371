<?
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$sname = $_POST['sname'];
$sagency = $_POST['sagency'];
$sgenre = $_POST['sgenre'];
$major = $_POST['major'];
$phone = $_POST['phone'];
$recordno = $_POST['recordno'];

$result = mysqli_query($conn, "insert into session (sname, sagency, sgenre, major, phone, recordno) 
						values('$sname', '$sagency', '$sgenre', '$major', '$phone', '$recordno')");
if(!$result)
{
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 입력 되었습니다');
    echo "<script>location.replace('session_list.php');</script>";
}

?>

