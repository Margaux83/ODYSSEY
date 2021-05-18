<?php
namespace App\Models;

use App\Core\Database;

class User extends Database
{
    private $id=null;
    protected $firstname;
    protected $lastname;
    protected $email;
    protected $password;
    protected $status;
    protected $role;
    protected $isDeleted;

    /**
     * User constructor.
     */
    public function __construct(){
        parent::__construct();
    }

    /**
     * @param $id
     */
    public function setId($id){
        $this->id = $id;
        //Il va chercher en BDD toutes les informations de l'utilisateur
        $data = array_diff_key(
            get_object_vars($this),
            get_class_vars(get_parent_class())
        );
        $columns = array_keys($data);

        $statement = $this->pdo->prepare("SELECT " . implode(',', $columns) . " FROM ".$this->table." WHERE id=:id");
        $statement->execute(array(":id" => $this->getId()));
        $obj = $statement->fetchObject(__CLASS__);

        $this->setUserFromObj($obj);
    }

    private function setUserFromObj($obj){
        $data = array_diff_key(
            get_object_vars($this),
            get_class_vars(get_parent_class())
        );
        $columns = array_keys($data);

        foreach ($columns as $key => $value) {
            $getAction = 'get' . ucfirst(trim($value));
            $objReturnedValue = $obj->$getAction();
            if (!empty($objReturnedValue)){
                $setAction = 'set' . ucfirst(trim($value));
                if ($setAction !== 'setId'){
                    $this->$setAction($objReturnedValue);
                }
            }
        }
    }

    /**
     * @return |null
     */
    public function getId(){
        return $this->id;
    }

    /**
     * @param $firstname
     */
    public function setFirstname($firstname){
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param $lastname
     */
    public function setLastname($lastname){
        $this->lastname = $lastname;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param $pwd
     */
    public function setPassword($password){
        $this->password = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param $country
     */
    public function setCountry($country){
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param $status
     */
    public function setStatus($status){
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param $role
     */
    public function setRole($role){
        $this->role = $role;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param $isDeleted
     */
    public function setIsDeleted($isDeleted){
        $this->isDeleted = $isDeleted;
    }

    /**
     * @return mixed
     */
    public function getIsDeleted()
    {
        return $this->isDeleted;
    }

    public function buildFormProfile()
    {
        return [
            "config" => [
				"method" => "POST",
				"Action" => "",
				"Submit" => "Modifier",
				"class" => "form_register"
			],
            "input" => [
                "firstname"=>[
                    "type"=>"text",
                    "class"=>"form_input",
                    "label"=>"Prénom",
                    "lengthMax"=>"120",
                    "lengthMin"=>"2",
                    "required"=>true,
                    "error"=>"Votre prénom doit faire entre 2 et 120 caractères",
                    "placeholder"=>"Votre prénom",
                    "defaultValue" => $this->getFirstname()
                ],
                "lastname"=>[
                    "type"=>"text",
                    "label"=>"Nom",
                    "lengthMax"=>"255",
                    "lengthMin"=>"2",
                    "required"=>true,
                    "error"=>"Votre nom doit faire entre 2 et 255 caractères",
                    "placeholder"=>"Votre nom",
                    "defaultValue" => $this->getLastname()
                ],
                "email"=>[
                    "type"=>"email",
                    "label"=>"Email",
                    "lengthMax"=>"320",
                    "lengthMin"=>"8",
                    "required"=>true,
                    "error"=>"Votre email doit faire entre 8 et 320 caractères",
                    "placeholder"=>"Votre email",
                    "defaultValue" => $this->getEmail()
                ]
            ]
        ];
    }

    /**
     * @return array
     */
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