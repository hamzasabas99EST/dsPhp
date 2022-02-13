<?php

use PHPMailer\PHPMailer\PHPMailer as PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


    function setupemail(){
        
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->SMTPAuth=EMAIL_Auth;
        $mail->Host = EMAIL_HOST;
        $mail->SMTPSecure = EMAIL_SECURE;
        $mail->Port = EMAIL_PORT;
        $mail->Username =EMAIL_USERNAME;
        $mail->Password=EMAIL_PASSWORD;
        $mail->IsHTML(true);

        return $mail;
            
    }


    function crypt_var($email){
        $secret_key='1f4276388ad3214c873428dbef42243f';
        $key=hex2bin($secret_key);
        $nonceSize=openssl_cipher_iv_length('AES-128-CTR');
        $nonce=openssl_random_pseudo_bytes($nonceSize);
        $ciphertext=openssl_encrypt($email,'AES-128-CTR',$key,OPENSSL_RAW_DATA,$nonce);
        return strtr(base64_encode($nonce.$ciphertext), '+/=', '-_,');
    }

    function decrypt_var($email){
      
        $secret_key='1f4276388ad3214c873428dbef42243f';
        $key=hex2bin($secret_key); 
        $email=base64_decode(strtr($email, '-_,', '+/='));
        $nonceSize =openssl_cipher_iv_length('AES-128-CTR');
        $nonce =mb_substr($email, 0, $nonceSize, '8bit');
        $ciphertext=mb_substr($email,$nonceSize,null,'8bit');
        
        $decrypted_text=openssl_decrypt(
            $ciphertext,
            'AES-128-CTR',
            $key,
            OPENSSL_RAW_DATA,
            $nonce
        );
        
        return $decrypted_text;
    }


?>