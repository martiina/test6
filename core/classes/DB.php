<?php

/*
 * Database class
*/

class DB {
	private $_pdo,
			$_query,
            $_error = false,
            $_results,
            $_count = 0;

	private static $_instance = NULL;

	/*
	 * Create a MySQL connection with PDO with credentials that comes from config file.
	 * return PDO Object
	*/
	private function __construct() {
		try {
			$this->_pdo = new PDO('mysql:host=' . Config::get('database.hostname') . ';dbname=' . Config::get('database.dbname') . ';', Config::get('database.username'), Config::get('database.password'));
		} catch(PDOException $e) {
			die($e->getMessage());
		}
	}

	/*
	 * Create only one instance not multiple.
	 * return Database Instance.
	*/
	public static function getInstance() {
        if(!isset(self::$_instance)) {
            self::$_instance = new DB();
        }
        return self::$_instance;
    }

    /*
	 * MYSQL query function.
	 * @params $sql MySQL query string.
	 * @params $params Array, that replaces questionmarks
	 * return MySQL Query.
	*/
    public function query($sql, $params = array()) {
        $this->_error = false;
        if($this->_query = $this->_pdo->prepare($sql)){
            if(count($params)) {
                $counter = 1;
                foreach($params as $param) {
                    $this->_query->bindValue($counter, $param);
                    $counter++;
                }
            }
            if($this->_query->execute()) {
                $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();
            } else {
                $this->_error = true;
            }
        }
        return $this;
    }

    /*
     * Gets a rowCount from database.
     * return MySQL rowCount.
    */
    public function count() {
        return $this->_count;
    }

    /*
     * Gets all results from database.
     * return MySQL results.
    */
    public function results() {
        return $this->_results;
    }

    /*
     * Gets first result from database
     * return MySQL results.
    */
    public function first() {
        return $this->_results[0];
    }

    /*
	 * Get MySQL errors.
    */
    public function error() {
        return $this->_error;
    }

    /*
	 * Insert data to MySQL with array
    */
    public function insert($table, $fields) {
        if(count($fields)) {
            $keys    = array_keys($fields);
            $values  = null;
            $counter = 1;
 
            foreach($fields as $field) {
                $values .= "?";
                if($counter < count($fields)) {
                    $values .= ', ';
                }
                $counter++;
            }
 
            $sql = "INSERT INTO {$table} (`" . implode('`, `',$keys) . "`) VALUES ({$values})";
             
            if(!$this->query($sql, $fields)->error()){
                return true;
            }
        }
        return false;
    }
}