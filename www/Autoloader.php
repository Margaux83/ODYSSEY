<?php
namespace App;

class Autoloader
{

	public static function register(){

		//Executer une fonction si on essaye d'instancier un class inconnue
		spl_autoload_register(function ($class){
			
			//   App\Core\routing -> \Core\routing
			$class = str_ireplace(__NAMESPACE__, "", $class);
			
			// \Core\routing -> /Core/routing
			$class = str_ireplace("\\", "/", $class);

			// /Core/routing -> Core/routing
			$class = ltrim($class, "/");

			if(file_exists($class.".php")){
				include $class.".php";
			}


		});

	}



}