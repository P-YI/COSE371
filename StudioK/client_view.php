<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("cno", $_GET)) {
    $cno = $_GET["cno"];
    $query = "select * from client inner join producer on client.producerno = producer.pno where cno = $cno";
    $result = mysqli_query($conn, $query);
    $client = mysqli_fetch_assoc($result);
    if (!$client) {
        msg("고객 정보가 존재하지 않습니다.");
    }
}
?>
    <div class="container fullwidth">

        <h3>고객 정보 상세 보기</h3>

        <p>
            <label for="cno">고객 번호</label>
            <input readonly type="text" id="cno" name="cno" value="<?= $client['cno'] ?>"/>
        </p>
        
        <p>
            <label for="cname">고객명</label>
            <input readonly type="text" id="cname" name="cname" value="<?= $client['cname'] ?>"/>
        </p>

		<p>
            <label for="cagency">소속사</label>
            <input readonly type="text" id="cagency" name="cagency" value="<?= $client['cagency'] ?>"/>
        </p>
        
        <p>
            <label for="cgenre">장르</label>
            <input readonly type="text" id="cgenre" name="cgenre" value="<?= $client['cgenre'] ?>"/>
        </p>
        
        <p>
            <label for="phone">전화번호</label>
            <input readonly type="text" id="phone" name="phone" value="<?= $client['phone'] ?>"/>
        </p>
        
        <p>
            <label for="album">음반명</label>
            <textarea readonly id="album" name="album" rows="5"><?= $client['album'] ?></textarea>
        </p>
        
        <p>
            <label for="sneed">필요세션인원</label>
            <input readonly type="text" id="sneed" name="sneed" value="<?= $client['sneed'] ?>"/>
        </p>

        <p>
            <label for="pno">제작자 번호</label>
            <input readonly type="text" id="pno" name="pno" value="<?= $client['pno'] ?>"/>
        </p>

        <p>
            <label for="pname">제작자명</label>
            <input readonly type="text" id="pname" name="pname" value="<?= $client['pname'] ?>"/>
        </p>

    </div>
<? include "footer.php" ?>