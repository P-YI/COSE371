<?
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$cname = $_POST['cname'];
$cagency = $_POST['cagency'];
$cgenre = $_POST['cgenre'];
$phone = $_POST['phone'];
$album = $_POST['album'];
$sneed = $_POST['sneed'];
$producerno = $_POST['producerno'];

$result = mysqli_query($conn, "insert into client (cname, cagency, cgenre, phone, album, sneed, producerno) 
						values('$cname', '$cagency', '$cgenre', '$phone', '$album', '$sneed', '$producerno')");
if(!$result)
{
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 입력 되었습니다');
    echo "<script>location.replace('client_list.php');</script>";
}

?>