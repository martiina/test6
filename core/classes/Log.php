<?php

class Log {

	private $_folder;

	public function __construct() {
		$this->_folder = getcwd().'/logs/session.log';
	}

	/*
	 * Create entry in session.log file.
	*/
	public function create($string) {
		$this->writeToFile($this->_folder, $string);
	}

	/*
	 * One function to write in file.
	*/
	private function writeToFile($filename, $string) {
		$file = fopen($filename, 'a');
		fwrite($file, $string);
		fclose($file);
	}
}