<?php
require 'yconnect_php_sdk/lib/YConnect.inc';

// �A�v���P�[�V����ID, �V�[�N���bv�g
$client_id     = "dj0zaiZpPUR4R2E2ZDhEUzM3VCZkPVlXazlSVFp6U2pWVU16QW1jR285TUEtLSZzPWNvbnN1bWVyc2VjcmV0Jng9YWY-";
$client_secret = "003a9c286cea1910db99201a71d9d779d9f29f29";
// ���N�G�X�g�ƃR�[���o�b�N�Ԃ̌��ؗp�̃����_���ȕ�������w�肵�Ă�������
$state = "44Oq44Ki5YWF44Gr5L+644Gv44Gq44KL77yB";
// ���v���C�A�^�b�N�΍�̃����_���ȕ�������w�肵�Ă�������
$nonce = "5YOV44Go5aWR57SE44GX44GmSUTljqjjgavjgarjgaPjgabjgog=";


$code = $_REQUEST['code'];
$state = $_REQUEST['state'];
$is_login = 0;

// �N���f���V�����C���X�^���X����
$cred = new ClientCredential( $client_id, $client_secret );
// YConnect�N���C�A���g�C���X�^���X����
$client = new YConnectClient( $cred );
 
if (isset($code) && isset($state)) {

     // Authorization Code���擾
 //   $code_result = $client->getAuthorizationCode( $state );

//        /*****************************
//             Verification ID Token
//        *****************************/

        // ID�g�[�N��������
 //       $client->verifyIdToken( $nonce );

//        /************************
//             UserInfo Request
//        ************************/

        // UserInfo�G���h�|�C���g�Ƀ��N�G�X�g
//        $client->requestUserInfo( $client->getAccessToken() );

        // UserInfo�����擾
//        $user_date = $client->getUserInfo() ;
     
    $user_id = '1';
    $is_login = 1;
}

?>

<!DOCTYPE html>
<html>
  <head>
  �@<meta name="ROBOTS" content="NOINDEX,NOFOLLOW">

    <title>(&lt;o&gt; &lt;o&gt;)</title>
    <script type="text/javascript"
      src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js">
    </script>
    <link href="http://static0.twilio.com/packages/quickstart/client.css"
      type="text/css" rel="stylesheet" />
<style>
body{
    background: none;
}

input#sender {
    margin-top: 300px;
}

button.call {
    margin: 50px 0 50px 0;
}

#log{
    margin-bottom: 50px;
}

</style>
<script type="text/javascript">
$(function(){
      $('#call').bind('click', function() {
        // get the phone number or client to connect the call to

        var $receiver=$("#receiver").val();
	    var $sender=$("#sender").val();
        $.ajax({
		  type: "GET",
		  url: "./call.php",
		  data: "Sender="+$sender+"&Receiver="+$receiver,
		  dataType: "json",
		  success: function(data){
		       if (data.result == true) {
		           $("#log").text('�d�b���Ă��܂��B���΂炭���҂����������B');		       
		       } else {
		           if (data.code == '102') {
		               $("#log").text('�؂�̂� �S���� �I �Ăւ؂끚 ');
		           }
		       }
		  }
	    });
      });
      });
</script>
</head>
  <body>
<!-- ���O�C����� -->

<?php if ($is_login) { ?>
    <input type="hidden" id="sender" name="user_id"
      value="<?php echo $user_id; ?>"/> 

    <input type="text" id="receiver" name="tel_id"
      placeholder="Please input callee ID."/>

    <button class="call"  id="call">
      Call
    </button>
        <div id="log">(&lt;o&gt; &lt;o&gt;) &lt; ID����͌�ACall�{�^���������Ă��������B</div>
<?php } else { ?>
<br><br>
    <a href="../ui/yconnect.php">
    <img src="http://i.yimg.jp/images/login/btn/btnXSYid.gif" width="241" height="28" alt="Yahoo! JAPAN ID�Ń��O�C��" border="0">
    </a>
    <div id="log">(&lt;o&gt; &lt;o&gt;) &lt; ���O�C�����Ă��������B</div>
<?php } ?>    

  </body>
</html>
