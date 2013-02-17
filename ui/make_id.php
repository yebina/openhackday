<?php
require_once('db_lib.class.php'); 

try{
    $dbh = new C4SAPDO();

    $add_sts = htmlspecialchars($_POST['add_sts'], ENT_QUOTES);
    $add_times = htmlspecialchars($_POST['add_times'], ENT_QUOTES);

    // $sql = "insert into TEL_ID (USER_NAME, TEL) values ('".$add_sts."', ".$add_times.")";
    $sql = "insert into TEL_ID (LOCATION) values ('".$add_sts."')";
    
    $res = $dbh->exeQuery($sql);

}catch(PDOException $e){
    print('Error:'.$e->getMessage());
}
?>
