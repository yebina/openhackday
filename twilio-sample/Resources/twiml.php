<?php
header('Content-type: text/xml');

// put a phone number you've verified with Twilio to use as a caller ID number
$callerId = "+815031331466";

// put your default Twilio Client name here, for when a phone number isn't given
$number   = "jenny";

// get the telId
$telId = trim($_REQUEST['TelId']);
$location = trim($_REQUEST['location']);

// get the phone number from the page request parameters, if given
if (isset($_REQUEST['PhoneNumber'])) {
    $number = htmlspecialchars($_REQUEST['PhoneNumber']);
}

// wrap the phone number or client name in the appropriate TwiML verb
// by checking if the number given has only digits and format symbols
if (preg_match("/^[\d\+\-\(\) ]+$/", $number)) {
    $numberOrClient = "<Number>" . $number . "</Number>";
} else {
    $numberOrClient = "<Client>" . $number . "</Client>";
}
?>

<Response>
    <Say voice="woman" >It is a call from the <?php echo $location ?>. </Say>
    <Dial callerId="<?php echo $callerId ?>" action="http://cq2pbrm-amb-app000.c4sa.net/twilio-sample/delete.php?telid=<?php echo $telId ?>">
          <?php echo $numberOrClient ?>
    </Dial>
    <!--<Say voice="woman" >Do you remove this id ?</Say>-->
    <!--<Say voice="woman" >Goodbye</Say>-->
</Response>
