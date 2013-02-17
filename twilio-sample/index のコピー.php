<?php
include 'Services/Twilio/Capability.php';

// put your Twilio API credentials here
$accountSid = 'AC44160180d1d9e2b103c4ffbec7740897';
$authToken  = '4e2b10c59e60eaec90d962608a3e1db1';

// put your Twilio Application Sid here
$appSid     = 'AP36685b0e2fdb4bfc9eea362c8263b713';

// put your default Twilio Client name here
$clientName = 'jenny';

// get the Twilio Client name from the page request parameters, if given
if (isset($_REQUEST['client'])) {
    $clientName = $_REQUEST['client'];
}

$capability = new Services_Twilio_Capability($accountSid, $authToken);
$capability->allowClientOutgoing($appSid);
$capability->allowClientIncoming($clientName);
$token = $capability->generateToken();
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Hello Client Monkey 5</title>
    <script type="text/javascript"
      src="//static.twilio.com/libs/twiliojs/1.1/twilio.min.js"></script>
    <script type="text/javascript"
      src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js">
    </script>
    <link href="http://static0.twilio.com/packages/quickstart/client.css"
      type="text/css" rel="stylesheet" />
    <script type="text/javascript">

      Twilio.Device.setup("<?php echo $token; ?>");

      Twilio.Device.ready(function (device) {
        $("#log").text("Client '<?php echo $clientName ?>' is ready");
      });

      Twilio.Device.error(function (error) {
        $("#log").text("Error: " + error.message);
      });

      Twilio.Device.connect(function (conn) {
        $("#log").text("Successfully established call");
      });

      Twilio.Device.disconnect(function (conn) {
        $("#log").text("Call ended");
      });

      Twilio.Device.incoming(function (conn) {
        $("#log").text("Incoming connection from " + conn.parameters.From);
        // accept the incoming connection and start two-way audio
        conn.accept();
      });

      function call() {
        // get the phone number or client to connect the call to
	var $receiver=$("#receiver").val();
	var $sender=$("#sender").val();
	$.ajax({
		type: "GET",
		url: "./call.php",
		data: "SenderNum="+$sender+"&ReceiverNum="+$receiver,
		dataType: "json",
		success: function(){}
	});
      }

      function hangup() {
        Twilio.Device.disconnectAll();
      }
    </script>
  </head>
  <body>
    <button class="call" onclick="call();">
      Call
    </button>

    <button class="hangup" onclick="hangup();">
      Hangup
    </button>

    <input type="text" id="receiver" name="receiver"
      placeholder="receiver"/>
    <input type="text" id="sender" name="sender"
      placeholder="sender"/>

    <div id="log">Loading pigeons...</div>
  </body>
</html>
