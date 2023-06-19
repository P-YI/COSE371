<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from client inner join producer on client.producerno = producer.pno";
    if (array_key_exists("search_keyword", $_POST)) {  // array_key_exists() : Checks if the specified key exists in the array
        $search_keyword = $_POST["search_keyword"];
        $query .= " where cname like '%$search_keyword%' or pname like '%$search_keyword%'";
    }
    $result = mysqli_query($conn, $query);
    if (!$result) {
         die('Query Error : ' . mysqli_error());
    }
    ?>

    <table class="table table-striped table-bordered">
        <tr>
            <th>No.</th>
            <th>고객명</th>
            <th>소속사</th>
            <th>장르</th>
            <th>제작자</th>
            <th>기능</th>
        </tr>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>{$row_index}</td>";
            echo "<td><a href='client_view.php?cno={$row['cno']}'>{$row['cname']}</a></td>";
            echo "<td>{$row['cagency']}</td>";
            echo "<td>{$row['cgenre']}</td>";
            echo "<td>{$row['pname']}</td>";
            echo "<td width='17%'>
                <a href='client_form.php?cno={$row['cno']}'><button class='button primary small'>수정</button></a>
                 <button onclick='javascript:deleteConfirm({$row['cno']})' class='button danger small'>삭제</button>
                </td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
    </table>
    <script>
        function deleteConfirm(cno) {
            if (confirm("정말 삭제하시겠습니까?") == true){    //확인
                window.location = "client_delete.php?cno=" + cno;
            }else{   //취소
                return;
            }
        }
    </script>
</div>
<? include("footer.php") ?>