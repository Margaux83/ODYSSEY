<?php

namespace App;

use App\Core\Security;
use App\Core\View;
use App\Models\User;
use App\Core\Form;


class Base{

    //Must be connected
    public function dashboardAction(){

        $security = new Security();
        if(!$security->isConnected()){
            die("Error not authorized");
        }


        //Affiche moi la vue dashboard;
        $view = new View("dashboard", "back");


    }


	public function formAction(){
        $user = new User();
		if(!empty($_POST)){
			$errors = Form::validator($_POST, $form);

			if(empty($errors)){

				$user->setFirstname("Toto");
				$user->setLastname("Titi");
				$user->setEmail("y.skrzypczyk@gmail.com");
				$user->setPwd("Test1234");
				$user->setCountry("fr");
				//$user->save();

			}else{
				$view->assign("formErrors", $errors);
			}

		}

		$view = new View("register", "front");
		// (text, email, date, password, radio, checkbox) 
		$form = [

			"config"=>[
				"method"=>"POST",
				"Action"=>"",
				"Submit"=>"S'inscrire",
				"class"=>"form_register"
			],
			"input"=>[
				"firstname"=>[
								"type"=>"text",
								"class"=>"form_input",
								"label"=>"Prénom",
								"lengthMax"=>"120",
								"lengthMin"=>"2",
								"required"=>true,
								"error"=>"Votre prénom doit faire entre 2 et 120 caractères",
								"placeholder"=>"Votre prénom"
								],
				"lastname"=>[
								"type"=>"text",
								"lengthMax"=>"255",
								"lengthMin"=>"2",
								"required"=>true,
								"error"=>"Votre nom doit faire entre 2 et 255 caractères",
								"placeholder"=>"Votre nom"
								],
				"email"=>[
								"type"=>"email",
								"lengthMax"=>"320",
								"lengthMin"=>"8",
								"required"=>true,
								"error"=>"Votre email doit faire entre 8 et 320 caractères",
								"placeholder"=>"Votre email"
								],
				"pwd"=>[
								"type"=>"password",
								"lengthMin"=>"8",
								"required"=>true,
								"error"=>"Votre mot de passe doit faire plus de 8 caractères",
								"placeholder"=>"Votre mot de passe"
								],
				"pwdConfirm"=>[
								"type"=>"password",
								"confirm"=>"pwd",
								"required"=>true,
								"error"=>"Votre mot de passe de confirmation est incorrect",
								"placeholder"=>"Confirmation"
								],
				"selectForm"=>[
								"type"=>"select",
								"label"=>"Pays",
								"required"=>true,
								"error"=>"Veuillez sélectionner un élément",
								"placeholder"=>"Choisir un pays",
								"options"=>[
									"fr"=>[
										"label" => "France",
										],
									"uk"=>[
										"label" => "Angleterre",
										],
									"usa"=>[
										"label" => "Etats-Unis"
										]
									],
				
								],
				"birthday"=>[
					"type"=>"date",
					"label"=>"Date de naissance",
					"confirm"=>"pwd",
					"required"=>true,
					"dateMax"=>"".date('d-m-Y')."",
					"dateMin"=>"01/01/1920",
					"error"=>"La date de naissance ne peut pas être supérieure à la date d'aujourd'hui",
					"placeholder"=>"Confirmation"
				],
				"genre"=>[
					"type"=>"radio",
					"label"=>"Genre",
					"required"=>false,
					"placeholder"=>"Choisir un genre",
					"options" => [
						"homme" => [
							"label" => "Homme"
						],
						"femme" => [
							"label" => "Femme"
						]
					]
					],
				"conditions"=>[
						"type"=>"checkbox",
						"label"=>"Conditions",
						"required"=>false,
						"placeholder"=>"Choisir un genre",
						"options" => [
							"newsletter" => [
								"label" => "Je m'abonne à la newsletter"
							],
							"acceptConditions" => [
								"label" => "J'accepte les conditions d'utilisations"
							]
						]
						],
			]

		];
		$view->assign("form", $form);

		if(!empty($_POST)){
			$errors = Form::validator($_POST, $form);

			if(empty($errors)){

				$user->setFirstname("Toto");
				$user->setLastname("Titi");
				$user->setEmail("y.skrzypczyk@gmail.com");
				$user->setPwd("Test1234");
				$user->setCountry("fr");
				//$user->save();

			}else{
				$view->assign("formErrors", $errors);
			}

		}

    }





}

