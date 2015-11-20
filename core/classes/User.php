<?php

class User {

	private $_db, $_sessionName, $_data, $_isLoggedIn;

	public function __construct($user = null) {
		$this->_db = DB::getInstance();
		$this->_sessionName = Config::get('app.session-name');

		if(!$user) {
            if(Session::exists($this->_sessionName)) {
                $user = Session::get($this->_sessionName);
 
                if($this->find($user)) {
                    $this->_isLoggedIn = TRUE;
                }
            } else {
            	$this->_isLoggedIn = FALSE;
            }
        } else {
            $this->find($user);
        }
	}

	public function find($user = null) {
        if($user) {
            $field = (is_numeric($user)) ? 'id' : 'username';
            $data = $this->_db->query("SELECT * FROM users WHERE {$field} = ?", array($user));
             
            if($data->count()) {
                $this->_data = $data->first();
                return TRUE;
            }
        }
        return FALSE;
    }

	/*
	 * Loggin in USER, if data is correct and validated.
	*/
	public function login($username, $password) {
		$user = $this->find($username);
		if($user) {
			$salt = $this->data()->salt;
			if($this->data()->password === Hash::make($password, $salt)) {
                Session::put($this->_sessionName, $this->data()->id);
                return TRUE;
            }
		}
		return FALSE;
	}

	/*
	 * Registering USER, if data is correct and validated.
	*/
	public function register($user, $pass) {

		$salt = Hash::salt(32);

		$sql = $this->_db->insert('users', array('username' => $user, 'password' => Hash::make($pass, $salt), 'salt' => $salt));

		if($sql) {
			return TRUE;
		}
		return FALSE;
	}

	/*
	 * Get user data.
	*/
	public function data() {
		return $this->_data;
	}

	/*
	 * Check, if user is logged in..
	*/
	public function isLoggedIn() {
		return $this->_isLoggedIn;
	}

	/*
	 * Logout user.
	*/
	public function logout() {     
        Session::delete($this->_sessionName);
    }
}