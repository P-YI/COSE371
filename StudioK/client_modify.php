<?
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$cno = $_POST['cno'];
$cname = $_POST['cname'];
$cagency = $_POST['cagency'];
$cgenre = $_POST['cgenre'];
$phone = $_POST['phone'];
$album = $_POST['album'];
$sneed = $_POST['sneed'];
$producerno = $_POST['producerno'];

$result = mysqli_query($conn, "update client set cname = '$cname', cagency = '$cagency', 
						cgenre = '$cgenre', phone = '$phone', album = '$album',
						sneed = '$sneed', producerno = '$producerno' where cno = $cno");

if(!$result)
{
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 수정 되었습니다');
    echo "<script>location.replace('client_list.php');</script>";
}

?>
