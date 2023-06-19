<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    // $query = "select * from session_request";
    // $query = "SELECT session_request.*, client.cname FROM session_request INNER JOIN client ON session_request.requested_c = client.cno";
    $query = "SELECT session_request.*, client.cname, session.sname 
          FROM session_request 
          INNER JOIN client ON session_request.requested_c = client.cno 
          LEFT JOIN session ON session_request.matched_s = session.sno";
    if (array_key_exists("search_keyword", $_POST)) {  // array_key_exists() : Checks if the specified key exists in the array
        $search_keyword = $_POST["search_keyword"];
        $query .= " where rno like '%$search_keyword%'";
    }
    $result = mysqli_query($conn, $query);
    if (!$result) {
         die('Query Error : ' . mysqli_error());
    }
    ?>

    <table class="table table-striped table-bordered">
        <tr>
            <th>No.</th>
            <th>신청번호</th>
            <th>신청일시</th>
            <th>필요악기</th>
            <th>신청고객</th>
            <th>매칭세션</th>
            <th>기능</th>
        </tr>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>{$row_index}</td>";
            echo "<td>{$row['rno']}</td>";
            echo "<td>{$row['date']}</td>";
            echo "<td>{$row['inst_need']}</td>";
            // echo "<td>{$row['requested_c']}</td>";
            // echo "<td><a href='client_view.php?cno={$row['cno']}'>{$row['cname']}</a></td>";
            echo "<td><a href='client_view.php?cno={$row['requested_c']}'>{$row['cname']}</a></td>";
            echo "<td><a href='session_view.php?sno={$row['matched_s']}'>{$row['sname']}</a></td>";
            // echo "<td>{$row['matched_s']}</td>";
            echo "<td width='17%'>
                <a href='session_request_form.php?rno={$row['rno']}'><button class='button primary small'>수정</button></a>
                 <button onclick='javascript:deleteConfirm({$row['rno']})' class='button danger small'>삭제</button>
                </td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
    </table>
    <script>
        function deleteConfirm(rno) {
            if (confirm("정말 삭제하시겠습니까?") == true){    //확인
                window.location = "session_request_delete.php?rno=" + rno;
            }else{   //취소
                return;
            }
        }
    </script>
</div>
<? include("footer.php") ?>