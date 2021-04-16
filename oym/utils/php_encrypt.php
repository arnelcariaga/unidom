<?php
define('METHOD','AES-256-CBC');
define('SECRET_KEY',']L!@#$%^`&546UNIDom^dfgd&UQY)q1T2nP&*%^&*("{N');
define('SECRET_IV','s$%^&rB;unidom19EduCa|$Z<opEc9.dg<L^&*()##$ffsa8=');
class SED {
	public static function encryption($string){
		$output=FALSE;
		$key=hash('sha256', SECRET_KEY);
		$iv=substr(hash('sha256', SECRET_IV), 0, 16);
		$output=openssl_encrypt($string, METHOD, $key, 0, $iv);
		$output=base64_encode($output);
		return $output;
	}
	public static function decryption($string){
		$key=hash('sha256', SECRET_KEY);
		$iv=substr(hash('sha256', SECRET_IV), 0, 16);
		$output=openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
		return $output;
	}
}
?>