<?php
// Download/Install the PHP helper library from twilio.com/docs/libraries.
// This line loads the library
require('Services/Twilio.php');
require_once('../api/db_lib.class.php');

$sender_id = trim($_REQUEST['Sender']);
$receiver_id = trim($_REQUEST['Receiver']);

$res = array();

// get telephone number.
$db = new C4SAPDO();
$sql = "select user_id, tel from USER_M where user_id = ".$sender_id;
$result = $db->exeQuery($sql);
$result = $result[0];
if(empty($result)){
    $res['result'] = false;
    $res['code'] = 100;
    $res['msg'] = "user is not found.";
    echo json_encode($res);
    return;
}	
$sender = $result['tel'];

#$sql = "select user_id, tel from USER_M where user_id = ".$receiver_id;
$sql = "SELECT m.user_id, m.tel, t.tel_id, t.location, t.status FROM USER_M m, TEL_ID t WHERE m.user_id = t.user_id and t.tel_id = ".$receiver_id;
$result = $db->exeQuery($sql);
if(empty($result)){
    $res['result'] = false;
    $res['code'] = 101;
    $res['msg'] = "user is not found.";
    echo json_encode($res);
    return;
}	
$result = $result[0];
if($result['status'] !== '0'){
    $res['result'] = false;
    $res['code'] = 102;
    $res['msg'] = "invalid status.";
    echo json_encode($res);
    return;
}

$receiver = $result['tel'];
$telId = $result['tel_id'];
$location = $result['location'];

#print_r($result);

 
// Your Account Sid and Auth Token from twilio.com/user/account
$sid = 'AC44160180d1d9e2b103c4ffbec7740897';
$token  = '4e2b10c59e60eaec90d962608a3e1db1';
$client = new Services_Twilio($sid, $token);


$url = "http://cq2pbrm-amb-app000.c4sa.net/twilio-sample/Resources/twiml.php?PhoneNumber=" . $sender. "&TelId=" . $telId . "&location=".$location;
#echo $url;

// create("認証済みの番号", "相手の番号", "xmlのurl", "??")
//echo "sender:$sender, receiver:$receiver";
$call = $client->account->calls->create("+815031331466", $receiver, $url, array());
#echo $call->sid;
$res['result'] = true;
$res['sid'] = $call->sid;
echo json_encode($res);
?>
