<!DOCTYPE html>
<html lang='ko'>
<head>
    <title>Studio-K</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<form action="client_list.php" method="post">
    <div class='navbar fixed'>
        <div class='container'>
            <a class='pull-left title' href="index.php">Studio-K</a>
            <ul class='pull-right'>
            	<li>
                    <input type="text" name="search_keyword" placeholder="고객 정보 검색">
                </li>
                <li><a href='client_list.php'>고객 목록</a></li>
                <li><a href='client_form.php'>고객 등록</a></li>
                <li><a href='session_list.php'>세션 목록</a></li>
                <li><a href='session_form.php'>세션 등록</a></li>
                <li><a href='session_request_form.php'>세션 신청</a></li>
                <li><a href='session_request_list.php'>신청서 목록</a></li>
                <li><a href='record_manage_form.php'>녹음 참여</a></li>
                <li><a href='record_manage_list.php'>녹음 목록</a></li>
            </ul>
        </div>
    </div>
</form>