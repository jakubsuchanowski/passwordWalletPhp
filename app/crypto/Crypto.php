<?php
class Crypto{
    private $key;
    public function __construct($key){
        $this->key = $key;
    } 

    public function encrypt($data){
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $encrypted = openssl_encrypt($data,'aes-256-cbc', $this->key,0, $iv);
        return base64_encode($encrypted. '::'. $iv);
    }

    public function decrypt($data){
        list($encrypted_data, $iv) = explode('::', base64_decode($data),2);
        return openssl_decrypt($encrypted_data,'aes-256-cbc',$this->key,0, $iv);
    }
}
?>