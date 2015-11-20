<?php

class Session {

	/*
	 * Set a session with name and assign a value for it.
	*/
	public static function put($name, $value) {
		return $_SESSION[$name] = $value;
	}

	/*
	 * Get a session value wuth name.
	*/
	public static function get($name) {
		return $_SESSION[$name];
	}

	/*
	 * Check, if session exists or not.
	*/
	public static function exists($name) {
		return (isset($_SESSION[$name])) ? TRUE : FALSE;
	}

	/*
	 * Deleting session, if it exists.
	*/
	public static function delete($name) {
        if(self::exists($name)) {
            unset($_SESSION[$name]);
        }
    }

    /*
	 * Flash messages. Just to show message for user only 1 time, not more.
	*/
    public static function flash($name, $string = '') {
        if(self::exists($name)) {
            $session = self::get($name);
            self::delete($name);
            return $session;
        } else {
            self::put($name, $string);
        }
    }
}