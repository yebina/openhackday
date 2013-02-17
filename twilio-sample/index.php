<?php
require 'yconnect_php_sdk/lib/YConnect.inc';

// アプリケーションID, シークレッvト
$client_id     = "dj0zaiZpPUR4R2E2ZDhEUzM3VCZkPVlXazlSVFp6U2pWVU16QW1jR285TUEtLSZzPWNvbnN1bWVyc2VjcmV0Jng9YWY-";
$client_secret = "003a9c286cea1910db99201a71d9d779d9f29f29";
// リクエストとコールバック間の検証用のランダムな文字列を指定してください
$state = "44Oq44Ki5YWF44Gr5L+644Gv44Gq44KL77yB";
// リプレイアタック対策のランダムな文字列を指定してください
$nonce = "5YOV44Go5aWR57SE44GX44GmSUTljqjjgavjgarjgaPjgabjgog=";


$code = $_REQUEST['code'];
$state = $_REQUEST['state'];
$is_login = 0;

// クレデンシャルインスタンス生成
$cred = new ClientCredential( $client_id, $client_secret );
// YConnectクライアントインスタンス生成
$client = new YConnectClient( $cred );
 
if (isset($code) && isset($state)) {

     // Authorization Codeを取得
 //   $code_result = $client->getAuthorizationCode( $state );

//        /*****************************
//             Verification ID Token
//        *****************************/

        // IDトークンを検証
 //       $client->verifyIdToken( $nonce );

//        /************************
//             UserInfo Request
//        ************************/

        // UserInfoエンドポイントにリクエスト
//        $client->requestUserInfo( $client->getAccessToken() );

        // UserInfo情報を取得
//        $user_date = $client->getUserInfo() ;
     
    $user_id = '1';
    $is_login = 1;
}

?>

<!DOCTYPE html>
<html>
  <head>
  　<meta name="ROBOTS" content="NOINDEX,NOFOLLOW">

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
		           $("#log").text('電話しています。しばらくお待ちください。');		       
		       } else {
		           if (data.code == '102') {
		               $("#log").text('切り捨て ゴメン ！ てへぺろ★ ');
		           }
		       }
		  }
	    });
      });
      });
</script>
</head>
  <body>
<!-- ログイン情報 -->

<?php if ($is_login) { ?>
    <input type="hidden" id="sender" name="user_id"
      value="<?php echo $user_id; ?>"/> 

    <input type="text" id="receiver" name="tel_id"
      placeholder="Please input callee ID."/>

    <button class="call"  id="call">
      Call
    </button>
        <div id="log">(&lt;o&gt; &lt;o&gt;) &lt; IDを入力後、Callボタンを押してください。</div>
<?php } else { ?>
<br><br>
    <a href="../ui/yconnect.php">
    <img src="http://i.yimg.jp/images/login/btn/btnXSYid.gif" width="241" height="28" alt="Yahoo! JAPAN IDでログイン" border="0">
    </a>
    <div id="log">(&lt;o&gt; &lt;o&gt;) &lt; ログインしてください。</div>
<?php } ?>    

  </body>
</html>
