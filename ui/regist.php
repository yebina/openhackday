<?php
require_once('db_lib.class.php'); 

try{
    $dbh = new C4SAPDO();

    $user = htmlspecialchars($_POST['user'], ENT_QUOTES);
    $tel_number = htmlspecialchars($_POST['tel_number'], ENT_QUOTES);

    $sql = "insert into USER_M (USER_NAME, TEL) values ('".$user."', ".$tel_number.")";

    $res = $dbh->exeQuery($sql);

}catch(PDOException $e){
    print('Error:'.$e->getMessage());
}
?>
