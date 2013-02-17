<?php
require_once('db_lib.class.php'); 

try{
    $dbh = new C4SAPDO();

    $user = htmlspecialchars($_POST['user'], ENT_QUOTES);
    $tel_number = htmlspecialchars($_POST['tel_number'], ENT_QUOTES);

    $sql = "select * from TEL_ID";

    $res = $dbh->exeQuery($sql);
    
    echo $res;

}catch(PDOException $e){
    print('Error:'.$e->getMessage());
}
?>
