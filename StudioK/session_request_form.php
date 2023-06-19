<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "session_request_insert.php";

if (array_key_exists("rno", $_GET)) {
    $rno = $_GET["rno"];
    $query = "select * from session_request where rno = $rno";
    $result = mysqli_query($conn, $query);
    $session_request = mysqli_fetch_array($result);
    if(!$session_request) {
        msg("신청한 적이 없습니다.");
    }
    $mode = "수정";
    $action = "session_request_modify.php";
}

$clients = array();

$query = "select * from client";
$result = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($result)) {
    $clients[$row['cno']] = $row['cname'];
}

$sessions = array();

$query = "select * from session";
$result = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($result)) {
    $sessions[$row['sno']] = $row['sname'];
}
?>
    <div class="container">
        <form name="session_request_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="rno" value="<?=$session_request['rno']?>"/>
            <h3>세션 요청 정보 <?=$mode?></h3>
            <p>
                <label for="inst_need">필요 악기명</label>
                <textarea placeholder="필요 악기 입력" id="inst_need" name="inst_need" rows="5"><?=$session_request['inst_need']?></textarea>
            </p>
            <p>
                <label for="requested_c">신청 고객</label>
                <select name="requested_c" id="requested_c">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($clients as $id => $name) {
                            if($id == $session_request['requested_c']){
                                echo "<option value='{$id}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
            <p>
                <label for="matched_s">매칭 세션</label>
                <select name="matched_s" id="matched_s">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($sessions as $id => $name) {
                            if($id == $session_request['matched_s']){
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
                    if(document.getElementById("requested_c").value == "") {
                        alert ("신청 고객을 선택해 주십시오"); return false;
                    }
                    else if(document.getElementById("matched_s").value == "") {
                        alert ("매칭을 원하는 세션을 선택해 주십시오"); return false;
                    }
                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>