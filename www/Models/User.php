<?php
namespace App\Models;

use App\Core\Database;

class User extends Database
{
    private $id=null;
    protected $firstname;
    protected $lastname;
    protected $email;
    protected $pwd;
    protected $country;
    protected $status;
    protected $role;
    protected $isDeleted;

    public function __construct(){
        parent::__construct();
    }

    public function setId($id){
        $this->id = $id;
        //Il va chercher en BDD toutes les informations de l'utilisateur

        $statement = $this->pdo->prepare("SELECT id, firstname, lastname, email, pwd, country FROM ".$this->table." WHERE id=:id");
        $statement->execute(array(":id" => $this->getId()));
        $obj = $statement->fetchObject(__CLASS__);
        //$array = (array)$obj;


        var_dump($obj);




        //et il va alimenter l'objet avec toutes ces données
        // $objects = [];
        /* while ($obj = $statement->fetchObject(__CLASS__)) {
            //var_dump($obj);
             $array = (array)$obj;
             var_dump($array);
         }*/
        //var_dump(array_diff_key($array,$myfields));

    }
  
    public function getId(){
        return $this->id;
    }


    public function setFirstname($firstname){
        $this->firstname = $firstname;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function setLastname($lastname){
        $this->lastname = $lastname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setPwd($pwd){
        $this->pwd = $pwd;
    }

    public function getPwd()
    {
        return $this->pwd;
    }

    public function setCountry($country){
        $this->country = $country;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function setStatus($status){
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setRole($role){
        $this->role = $role;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setIsDeleted($isDeleted){
        $this->isDeleted = $isDeleted;
    }

    public function getIsDeleted()
    {
        return $this->isDeleted;
    }


	public function buildFormRegister(){
		return [

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
					"dateMax"=>"".date('Y-m-d')."",
					"dateMin"=>"1920-01-01",
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
	}

}

