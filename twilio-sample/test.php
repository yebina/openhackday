<?php
echo "abc";
require_once('../api/db_lib.class.php');

$id = "1";
$sql = "select user_id, user_name, tel from USER_M where user_id = ".$id;

$db = new C4SAPDO();
$result = $db->exeQuery($sql);

?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php print_r($result) ?>
</html>
