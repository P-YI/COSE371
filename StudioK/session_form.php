<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "session_insert.php";

if (array_key_exists("sno", $_GET)) {
    $sno = $_GET["sno"];
    $query = "select * from session where sno = $sno";
    $result = mysqli_query($conn, $query);
    $session = mysqli_fetch_array($result);
    if(!$session) {
        msg("등록한 적이 없는 세션입니다.");
    }
    $mode = "수정";
    $action = "session_modify.php";
}

$record_manages = array();

$query = "select * from record_manage";
$result = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($result)) {
    $record_manages[$row['mno']] = $row['mno'];
}
?>
    <div class="container">
        <form name="session_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="sno" value="<?=$session['sno']?>"/>
            <h3>세션 정보 <?=$mode?></h3>
            <p>
                <label for="sname">세션명</label>
                <input type="text" placeholder="세션명 입력" id="sname" name="sname" value="<?=$session['sname']?>"/>
            </p>
            <p>
                <label for="sagency">소속사</label>
                <input type="text" placeholder="소속사명 입력" id="sagency" name="sagency" value="<?=$session['sagency']?>"/>
            </p>
            <p>
                <label for="sgenre">장르</label>
                <input type="text" placeholder="주요 장르 입력" id="sgenre" name="sgenre" value="<?=$session['sgenre']?>"/>
            </p>
            <p>
                <label for="major">전공악기</label>
                <textarea placeholder="전공 악기 입력" id="major" name="major" rows="5"><?=$session['major']?></textarea>
            </p>
            <p>
                <label for="phone">전화번호</label>
                <input type="text" placeholder="-없이 정수로 입력" id="phone" name="phone" value="<?=$session['phone']?>" />
            </p>
            <p>
                <label for="recordno">참여녹음번호</label>
                <select name="recordno" id="recordno">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($record_manages as $id => $name) {
                            if($id == $session['recordno']){
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
                    if(document.getElementById("sname").value == "") {
                        alert ("세션명을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("major").value == "") {
                        alert ("전공을 입력해 주십시오"); return false;
                    }
                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>