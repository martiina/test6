<?php

class Movie {

	private $_db, $_results, $_count, $_sessionName;

	public function __construct() {
		$this->_db = DB::getInstance();
		$this->_sessionName = Config::get('app.session-name');
	}

	/*
	 * Find a movie that matches with user ID.
	*/
	public function find($userid = NULL) {
		if($userid) {
			$fields = (is_numeric($userid)) ? 'user_id' : 'title';
			$movie = $this->_db->query("SELECT * FROM movies WHERE {$fields} = ?", array($userid));
			if($movie->count()) {
				$this->_results = $movie->results();
				$this->_count = $movie->count();
				return TRUE;
			}
		}
		return FALSE;
	}

	/*
	 * Get movie results.
	*/
	public function results() {
		return $this->_results;
	}

	/*
	 * Create new movie
	*/
	public function create($fields) {
		if($this->_db->insert('movies', $fields)) {
			return TRUE;
		}
		return FALSE;
	}

	/*
	 * Search for a movie
	*/
	public function search($key) {
		$search = $this->_db->query("SELECT * FROM movies WHERE user_id = ? AND title LIKE '%{$key}%'", array(Session::get($this->_sessionName)));
		if($search->count()) {
			return $search->results();
		}
		return FALSE;
	}

	/*
	 * If movie exists for current user
	*/
	public function exists($title) {
		$movie = $this->_db->query("SELECT user_id, title FROM movies WHERE user_id = ? AND title = ?", array(Session::get($this->_sessionName), $title));
		if($movie->count()) {
			return TRUE;
		}
		return FALSE;
	}
}