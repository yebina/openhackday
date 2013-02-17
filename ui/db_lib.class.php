<?php
class C4SAPDO {

    protected $dbh;

    public function __construct()
    {
        $domain = getenv('C4SA_MYSQL_HOST');  // ホスト
        $dbn = getenv('C4SA_MYSQL_DB');  // データベース名
        $dsn = 'mysql:dbname='.$dbn.';host='.$domain;

        $user = getenv('C4SA_MYSQL_USER');  // ユーザ名
        $password = getenv('C4SA_MYSQL_PASSWORD');  // パスワード

        try{
            $this->dbh = new PDO($dsn, $user, $password);

            print('接続に成功しました。<br>');

            $this->dbh->query('SET NAMES utf-8');
        
        }catch (PDOException $e){
            print('Error:'.$e->getMessage());
            die();
        }

    }
    
    public function exeQuery($sql){
        try{
            return $this->dbh->query($sql);
        }catch (PDOException $e){
            print('Error:'.$e->getMessage());
            die();
        }
    }
}
?>
