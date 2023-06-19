<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "record_manage_insert.php";

if (array_key_exists("mno", $_GET)) {
    $mno = $_GET["mno"];
    $query = "select * from record_manage where mno = $mno";
    $result = mysqli_query($conn, $query);
    $record_manage = mysqli_fetch_array($result);
    if(!$record_manage) {
        msg("신청한 적이 없습니다.");
    }
    $mode = "수정";
    $action = "record_manage_modify.php";
}

$requests = array();

$query = "select * from session_request";
$result = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($result)) {
    $requests[$row['rno']] = $row['rno'];
}
?>
    <div class="container">
        <form name="record_manage_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="mno" value="<?=$record_manage['mno']?>"/>
            <h3>녹음 관리 정보 <?=$mode?></h3>
            <p>
                <label for="turn">녹음 회차</label>
                <input type="number" placeholder="정수로 입력" id="turn" name="turn" value="<?=$record_manage['turn']?>" />
            </p>
            <p>
                <label for="match_no">세션 매칭 번호</label>
                <select name="match_no" id="match_no">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($requests as $id => $name) {
                            if($id == $record_manage['match_no']){
                                echo "<option value='{$id}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>

            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
                    if(document.getElementById("turn").value == "") {
                        alert ("녹음 회차를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("match_no").value == "") {
                        alert ("세션 매칭 번호를 선택해 주십시오"); return false;
                    }
                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>