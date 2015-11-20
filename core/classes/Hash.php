<?php
class Hash {
	/*
	 * Creating HASH. Using sha256 encryption.
	*/
    public static function make($string, $salt = '') {
        return hash('sha256', $string . $salt);
    }

    /*
	 * Create salt for users password. Random rubbish generated!
    */
    public static function salt($length) {
        return mcrypt_create_iv($length, MCRYPT_RAND);
    }

    /*
	 * Hashing unique ID for token sessions. ( for CSRF protection. )
    */
    public static function unique() {
        return self::make(uniqid());
    }
}