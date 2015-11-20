<?php

class Config {

	private static $_folder = '/config';

	/*
	 * Config kaustast võtame faili, mis on määratud muutujas $data ning võtame eraldaja abil (punkt) faili nime ja array väärtuse failist.
	*/
	public static function get($data = NULL) {
		if(!is_null($data)) {
			$details = explode('.', $data);

			$folder = getcwd().self::$_folder.'/'.$details[0].'.php';

			if(file_exists($folder)) {
				$getDetail = include $folder;

				return $getDetail[$details[1]];
			}
		}
		return false;
	}
}