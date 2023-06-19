<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("sno", $_GET)) {
    $sno = $_GET["sno"];
    $query = "select * from session where sno = $sno";
    $result = mysqli_query($conn, $query);
    $session = mysqli_fetch_assoc($result);
    if (!$session) {
        msg("세션 정보가 존재하지 않습니다.");
    }
}
?>
    <div class="container fullwidth">

        <h3>세션 정보 상세 보기</h3>

        <p>
            <label for="sno">세션 번호</label>
            <input readonly type="text" id="sno" name="sno" value="<?= $session['sno'] ?>"/>
        </p>
        
        <p>
            <label for="sname">세션명</label>
            <input readonly type="text" id="sname" name="sname" value="<?= $session['sname'] ?>"/>
        </p>

		<p>
            <label for="sagency">소속사</label>
            <input readonly type="text" id="sagency" name="sagency" value="<?= $session['sagency'] ?>"/>
        </p>
        
        <p>
            <label for="major">전공악기</label>
            <textarea readonly id="major" name="major" rows="5"><?= $session['major'] ?></textarea>
        </p>
        
        <p>
            <label for="phone">전화번호</label>
            <input readonly type="text" id="phone" name="phone" value="<?= $session['phone'] ?>"/>
        </p>
        
        <p>
            <label for="recordno">참여 녹음 번호</label>
            <input readonly type="text" id="recordno" name="recordno" value="<?= $session['recordno'] ?>"/>
        </p>
    </div>
<? include "footer.php" ?>