<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from record_manage";
    if (array_key_exists("search_keyword", $_POST)) {  // array_key_exists() : Checks if the specified key exists in the array
        $search_keyword = $_POST["search_keyword"];
        $query .= " where mno like '%$search_keyword%'";
    }
    $result = mysqli_query($conn, $query);
    if (!$result) {
         die('Query Error : ' . mysqli_error());
    }
    ?>

    <table class="table table-striped table-bordered">
        <tr>
            <th>No.</th>
            <th>녹음번호</th>
            <th>녹음회차</th>
            <th>녹음일시</th>
            <th>세션매칭번호</th>
            <th>기능</th>
        </tr>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>{$row_index}</td>";
            echo "<td>{$row['mno']}</td>";
            echo "<td>{$row['turn']}</td>";
            echo "<td>{$row['date']}</td>";
            echo "<td>{$row['match_no']}</td>";
            echo "<td width='17%'>
                <a href='record_manage_form.php?mno={$row['mno']}'><button class='button primary small'>수정</button></a>
                 <button onclick='javascript:deleteConfirm({$row['mno']})' class='button danger small'>삭제</button>
                </td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
    </table>
    <script>
        function deleteConfirm(mno) {
            if (confirm("정말 삭제하시겠습니까?") == true){    //확인
                window.location = "record_manage_delete.php?mno=" + mno;
            }else{   //취소
                return;
            }
        }
    </script>
</div>
<? include("footer.php") ?>