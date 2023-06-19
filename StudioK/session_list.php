<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from session";
    if (array_key_exists("search_keyword", $_POST)) {  // array_key_exists() : Checks if the specified key exists in the array
        $search_keyword = $_POST["search_keyword"];
        $query .= " where sname like '%$search_keyword%'";
    }
    $result = mysqli_query($conn, $query);
    if (!$result) {
         die('Query Error : ' . mysqli_error());
    }
    ?>

    <table class="table table-striped table-bordered">
        <tr>
            <th>No.</th>
            <th>세션명</th>
            <th>소속사</th>
            <th>장르</th>
            <th>전공악기</th>
            <th>기능</th>
        </tr>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>{$row_index}</td>";
            echo "<td><a href='session_view.php?sno={$row['sno']}'>{$row['sname']}</a></td>";
            echo "<td>{$row['sagency']}</td>";
            echo "<td>{$row['sgenre']}</td>";
            echo "<td>{$row['major']}</td>";
            echo "<td width='17%'>
                <a href='session_form.php?sno={$row['sno']}'><button class='button primary small'>수정</button></a>
                 <button onclick='javascript:deleteConfirm({$row['sno']})' class='button danger small'>삭제</button>
                </td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
    </table>
    <script>
        function deleteConfirm(sno) {
            if (confirm("정말 삭제하시겠습니까?") == true){    //확인
                window.location = "session_delete.php?sno=" + sno;
            }else{   //취소
                return;
            }
        }
    </script>
</div>
<? include("footer.php") ?>