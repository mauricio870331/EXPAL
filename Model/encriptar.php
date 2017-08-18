<?php
class Encrypter {
 
    private static $Key = "EP";
 
    public static function encrypt ($input) {
        $output = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5(Encrypter::$Key), $input, MCRYPT_MODE_CBC, md5(md5(Encrypter::$Key))));
        return $output;
    }
 
    public static function decrypt ($input) {
        $output = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5(Encrypter::$Key), base64_decode($input), MCRYPT_MODE_CBC, md5(md5(Encrypter::$Key))), "\0");
        return $output;
    }
 



}

/* $e = new  Encrypter();
 echo $e->encrypt("expresopalmira ")."<br>";
 echo $e->decrypt("rYV+/TQ3J54C1K/Jw5C6aj96juFlAZu9fvO4iuKUpmM=")."<br><br>";


 echo $e->encrypt("expresopalmira")."<br>";
 echo $e->decrypt("rhq0/yfrP+BoJTE3Gl2XN3JHMIPCsVdoTFdqAwmRMOw=")."<br><br>";*/

 
?>