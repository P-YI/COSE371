<?
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$mno = $_POST['mno'];
$turn = $_POST['turn'];
$match_no = $_POST['match_no'];

$result = mysqli_query($conn, "update record_manage set turn = '$turn', date = NOW(), match_no = '$match_no'  where mno = $mno");

if(!$result)
{
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 수정 되었습니다');
    echo "<script>location.replace('record_manage_list.php');</script>";
}

?>

