<?php

class Token {

    /*
     * Generating token
    */
    public static function generate() {
        return Session::put(Config::get('app.token_name'), Hash::unique());
    }   

    /*
     * Checking token.
    */
    public static function check($token) {  
        $tokenName = Config::get('app.token_name');
        if(Session::exists($tokenName) && $token === Session::get($tokenName)) {
            Session::delete($tokenName);
            return true;
        }
        return false;
    }
}