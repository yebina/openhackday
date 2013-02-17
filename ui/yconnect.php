<?php

// YConnect���C�u�����ǂݍ���
require("yconnect_php_sdk/lib/YConnect.inc");

// �A�v���P�[�V����ID, �V�[�N���bv�g
$client_id     = "dj0zaiZpPUR4R2E2ZDhEUzM3VCZkPVlXazlSVFp6U2pWVU16QW1jR285TUEtLSZzPWNvbnN1bWVyc2VjcmV0Jng9YWY-";
$client_secret = "003a9c286cea1910db99201a71d9d779d9f29f29";

// �e�p�����[�^������
$redirect_uri = "http://cq2pbrm-amb-app000.c4sa.net/twilio-sample/index.php";

// ���N�G�X�g�ƃR�[���o�b�N�Ԃ̌��ؗp�̃����_���ȕ�������w�肵�Ă�������
$state = "44Oq44Ki5YWF44Gr5L+644Gv44Gq44KL77yB";
// ���v���C�A�^�b�N�΍�̃����_���ȕ�������w�肵�Ă�������
$nonce = "5YOV44Go5aWR57SE44GX44GmSUTljqjjgavjgarjgaPjgabjgog=";

$response_type = OAuth2ResponseType::CODE_IDTOKEN;
$scope = array(
    OIDConnectScope::OPENID,
    OIDConnectScope::PROFILE,
    OIDConnectScope::EMAIL,
    OIDConnectScope::ADDRESS
);
$display = OIDConnectDisplay::DEFAULT_DISPLAY;
$prompt = array(
    OIDConnectPrompt::DEFAULT_PROMPT
    //OIDConnectPrompt::NONE
);

// �N���f���V�����C���X�^���X����
$cred = new ClientCredential( $client_id, $client_secret );
// YConnect�N���C�A���g�C���X�^���X����
$client = new YConnectClient( $cred );

// �f�o�b�O�p���O�o��
$client->enableDebugMode();

try {

    // Authorization Code���擾
    $code_result = $client->getAuthorizationCode( $state );

    if( !$code_result ) {

        /*****************************
             Authorization Request    
        *****************************/

        // Authorization�G���h�|�C���g�Ƀ��N�G�X�g
        
        $client->requestAuth(
            $redirect_uri,
            $state,
            $nonce,
            $response_type,
            $scope,
            $display,
            $prompt
        );

    } else {

        /****************************
             Access Token Request    
        ****************************/

        // Token�G���h�|�C���g�Ƀ��N�G�X�g
        $client->requestAccessToken(
            $redirect_uri,
            $code_result
        );

        /*****************************
             Verification ID Token
        *****************************/

        // ID�g�[�N��������
        $client->verifyIdToken( $nonce );

        /************************
             UserInfo Request
        ************************/

        // UserInfo�G���h�|�C���g�Ƀ��N�G�X�g
        $client->requestUserInfo( $client->getAccessToken() );

        // UserInfo�����擾
        echo "<pre>" . print_r( $client->getUserInfo(), true ) . "</pre>";

    }

} catch ( OAuth2ApiException $ae ) {

    // �A�N�Z�X�g�[�N�����L�������؂�ł��邩�`�F�b�N
    if( $ae->invalidToken() ) {

        /************************************
             Refresh Access Token Request
        ************************************/

        try {

            // �ۑ����Ă������t���b�V���g�[�N�����w�肵�Ă�������
            $refresh_token = "STORED_REFRESH_TOKEN";

            // Token�G���h�|�C���g�Ƀ��N�G�X�g���ăA�N�Z�X�g�[�N�����X�V
            $client->refreshAccessToken( $refresh_token );
            echo "<h1>Refresh Access Token Request</h1>";
            echo "ACCESS TOKEN : " . $client->getAccessToken() . "<br/><br/>";
            echo "EXPIRATION   : " . $client->getAccessTokenExpiration();

        } catch ( OAuth2TokenException $te ) {

            // ���t���b�V���g�[�N�����L�������؂�ł��邩�`�F�b�N
            if( $te->invalidGrant() ) {
                // �͂��߂�Authorization�G���h�|�C���g���N�G�X�g�����蒼���Ă�������
                echo "<h1>Refresh Token has Expired</h1>";
            }

            echo "<pre>" . print_r( $te, true ) . "</pre>";

        } catch ( Exception $e ) {
            echo "<pre>" . print_r( $e, true ) . "</pre>";
        }

    } else if( $ae->invalidRequest() ) {
        echo "<h1>Invalid Request</h1>";
        echo "<pre>" . print_r( $ae, true ) . "</pre>";
    } else {
        echo "<h1>Other Error</h1>";
        echo "<pre>" . print_r( $ae, true ) . "</pre>";
    }

} catch ( Exception $e ) {
    echo "<pre>" . print_r( $e, true ) . "</pre>";
}

/* vim:ts=4:sw=4:sts=0:tw=0:ft=php:set et: */
?>
