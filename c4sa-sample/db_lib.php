<html>
<head><title>PHP TEST</title></head>
<body>

<?php
$domain = getenv('C4SA_MYSQL_HOST');  // ホスト
$dbn = getenv('C4SA_MYSQL_DB');  // データベース名
$dsn = 'mysql:dbname='.$dbn.';host='.$domain;

$user = getenv('C4SA_MYSQL_USER');  // ユーザ名
$password = getenv('C4SA_MYSQL_PASSWORD');  // パスワード

echo $dsn;

try{
    $dbh = new PDO($dsn, $user, $password);

    print('接続に成功しました。<br>');

    $dbh->query('SET NAMES utf-8');

    $sql = 'select * from test';
    foreach ($dbh->query($sql) as $row) {
        print($row['id']);
        print($row['memo'].'<br>');
    }
}catch (PDOException $e){
    print('Error:'.$e->getMessage());
    die();
}

$dbh = null;

?>

</body>
</html>