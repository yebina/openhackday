<html>
<head>
<title>PHPでMySQLに接続するサンプルプログラム</title>
</head>
<body>
<?php

$domain = getenv('C4SA_MYSQL_HOST');  // ホスト
$user = getenv('C4SA_MYSQL_USER');  // ユーザ名
$password = getenv('C4SA_MYSQL_PASSWORD');  // パスワード
$dbname = getenv('C4SA_MYSQL_DB');  // データベース名


// MySQLに接続
$dbconnect = mysql_connect($domain, $user, $password)
             or die(mysql_error());
mysql_select_db($dbname, $dbconnect)
             or die(mysql_error());

$sql = "SELECT * FROM test";

// クエリの実行
$result = mysql_query($sql, $dbconnect);
if (!$result) {
    $message  = 'Invalid query: ' . mysql_error() . "\n";
    $message .= 'Whole query: ' . $query;
    die($message);
}

// 結果セットの行数を取得
$rows = mysql_num_rows($result);
echo $rows . '件のレコード<br />';
echo '<br />';

// 結果セットを表示
while ($row = mysql_fetch_assoc($result)) {
    echo $row['userid'] . '<br />';
    echo $row['username'] . '<br />';
    echo $row['mailaddr'] . '<br />';
    echo $row['hpurl'] . '<br />';
    echo '<br />';
}

mysql_free_result($result);
mysql_close($dbconnect);
?>
</body>
</html>