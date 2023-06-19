<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "client_insert.php";

if (array_key_exists("cno", $_GET)) {
    $cno = $_GET["cno"];
    $query =  "select * from client where cno = $cno";
    $result = mysqli_query($conn, $query);
    $client = mysqli_fetch_array($result);
    if(!$client) {
        msg("등록한 적이 없는 고객입니다.");
    }
    $mode = "수정";
    $action = "client_modify.php";
}

$producers = array();

$query = "select * from producer";
$result = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($result)) {
    $producers[$row['pno']] = $row['pname'];
}

?>
    <div class="container">
        <form name="client_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="cno" value="<?=$client['cno']?>"/>
            <h3>고객 정보 <?=$mode?></h3>
            <p>
                <label for="producerno">제작자</label>
                <select name="producerno" id="producerno">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($producers as $id => $name) {
                            if($id == $client['producerno']){
                                echo "<option value='{$id}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
            <p>
                <label for="cname">고객명</label>
                <input type="text" placeholder="고객명 입력" id="cname" name="cname" value="<?=$client['cname']?>"/>
            </p>
            <p>
                <label for="cagency">소속사</label>
                <input type="text" placeholder="소속사명 입력" id="cagency" name="cagency" value="<?=$client['cagency']?>"/>
            </p>
            <p>
                <label for="cgenre">장르</label>
                <input type="text" placeholder="주요 장르 입력" id="cgenre" name="cgenre" value="<?=$client['cgenre']?>"/>
            </p>
            <p>
                <label for="phone">전화번호</label>
                <input type="text" placeholder="-없이 정수로 입력" id="phone" name="phone" value="<?=$client['phone']?>" />
            </p>
            <p>
                <label for="album">음반명</label>
                <textarea placeholder="음반명 입력" id="album" name="album" rows="5"><?=$client['album']?></textarea>
            </p>
            <p>
                <label for="sneed">필요세션인원</label>
                <input type="number" placeholder="정수로 입력" id="sneed" name="sneed" value="<?=$client['sneed']?>" />
            </p>
           

            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
                    if(document.getElementById("pno").value == "-1") {
                        alert ("제작자를 선택해 주십시오"); return false;
                    }
                    else if(document.getElementById("cname").value == "") {
                        alert ("고객명을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("cgenre").value == "") {
                        alert ("장르를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("album").value == "") {
                        alert ("음반명을 입력해 주십시오"); return false;
                    }
                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>