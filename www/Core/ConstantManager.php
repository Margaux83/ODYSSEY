<?php

namespace App\Core;

class ConstantManager
{

	private $envFile = ".env";
	private $data = [];

	public function __construct(){

		if(!file_exists($this->envFile))
		die("Le fichier ".$this->envFile." n'existe pas");

		$this->parseFile($this->envFile);

		if(!empty($this->data["ENV"])){
			//Parse : .env.prod ou .env.dev
			$this->parseFile($this->envFile.".".$this->data["ENV"]);
		}

		$this->defineConstants();

	}

	public function defineConstants(){

		foreach ($this->data as $key => $value) {
			$this->defineConstant($key, $value);
		}
	}

	public static function defineConstant($key, $value) {
		$key = str_replace(" ", "_", mb_strtoupper(trim($key)));
		if(!defined($key)){
			define($key, trim($value));
		}else{
			die("Attention la constante ".$key." existe déjà");
		}
	}


	public function parseFile($file){
		$handle = fopen($file, "r");
		if(!empty($handle)){

			while (!feof($handle)) {
				$line = trim(fgets($handle));
				//  $line = "DBHOST=database #Voir le host de docker";
				//  $data["DBHOST"]="database";
				preg_match("/([^=]*)=([^#]*)/", $line, $results);
				if(!empty($results[1]) && !empty($results[2])){
					$this->data[$results[1]] = $results[2];
				}
			}

		}

	}

}