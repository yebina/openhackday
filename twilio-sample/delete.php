<?php
require_once('../api/db_lib.class.php');
header('Content-type: text/xml');

$tel_id = trim($_REQUEST['telid']);

$sql = "update TEL_ID set status = '1' where tel_id = '".$tel_id."'";
$db = new C4SAPDO();
$result = $db->exeQuery($sql);

?>
<Response>
    <Play loop="2">http://cq2pbrm-amb-app000.c4sa.net/twilio-sample/Resources/kirisute.mp3</Play>
    <Say voice="woman" >Goodbye</Say>
<Response>

