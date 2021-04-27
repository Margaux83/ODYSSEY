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
    protected $phone;
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
     * @param $password
     */
    public function setPassword($password){
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /*/**
     * @param mixed $confirmpwd

    public function setConfirmpwd($confirmpwd)
    {
        $this->confirmpwd = $confirmpwd;
    }*/

    /*/**
     * @return mixed

    public function getConfirmpwd()
    {
        return $this->confirmpwd;
    }
    */

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
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

    public function buildFormRegisterU(){
        return [
            "config"=>[
                "method"=>"POST",
                "Action"=>"",
                "reset" => "Annuler",
                "Submit"=>"Enregistrer",
                "class"=>"form-group"
            ],
            "input"=>[
                "lastname"=>[
                    "type"=>"text",
                    "label"=>"Nom",
                    "lengthMax"=>"255",
                    "lengthMin"=>"2",
                    "required"=>true,
                    "error"=>"Votre nom doit faire entre 2 et 255 caractères",
                    "placeholder"=>"Votre nom"
                ],
                "firstname"=>[
                    "type"=>"text",
                    "label"=>"Prénom",
                    "lengthMax"=>"120",
                    "lengthMin"=>"2",
                    "required"=>true,
                    "error"=>"Votre prénom doit faire entre 2 et 120 caractères",
                    "placeholder"=>"Votre prénom"
                ],
                "email"=>[
                    "type"=>"email",
                    "label"=>"Adresse Mail",
                    "lengthMax"=>"320",
                    "lengthMin"=>"8",
                    "required"=>true,
                    "error"=>"Votre email doit faire entre 8 et 320 caractères",
                    "placeholder"=>"Votre email"
                ],
                "password"=>[
                    "type"=>"password",
                    "label"=>"Mot de passe",
                    "lengthMin"=>"8",
                    "required"=>true,
                    "error"=>"Votre mot de passe doit faire plus de 8 caractères",
                    "placeholder"=>"Votre mot de passe"
                ],
                /*"pwdConfirm"=>[
                    "type"=>"password",
                    "label"=>"Confirmation de mot de passe",
                    "confirm"=>"pwd",
                    "required"=>true,
                    "error"=>"Votre mot de passe de confirmation est incorrect",
                    "placeholder"=>"Confirmation"
                ],*/
                "phone"=>[
                    "type"=>"text",
                    "label"=>"Numéro de téléphone",
                    "lengthMin"=>"10",
                    "required"=>true,
                    "error"=>"Votre numéro de téléphone doit contenir 10 chiffres",
                    "placeholder"=>"Votre numéro de téléphone"
                ],
                "conditions"=>[
                    "type"=>"checkbox",
                    "required"=>false,
                    "options" => [
                        "acceptConditions" => [
                            "label" => "Envoyer un mail au nouvel utilisateur pour le prévenir de la création de son compte"
                        ]
                    ]
                ],
            ]

        ];
    }

    public function buildFormUpdate(){
        return [
            "config"=>[
                "method"=>"POST",
                "Action"=>"",
                "reset" => "Annuler",
                "Submit"=>"Enregistrer",
                "class"=>"form-group"
            ],
            "input"=>[
                "lastname"=>[
                    "type"=>"text",
                    "label"=>"Nom",
                    "lengthMax"=>"255",
                    "lengthMin"=>"2",
                    "required"=>true,
                    "error"=>"Votre nom doit faire entre 2 et 255 caractères",
                    "placeholder"=>"Votre nom"
                ],
                "firstname"=>[
                    "type"=>"text",
                    "label"=>"Prénom",
                    "lengthMax"=>"120",
                    "lengthMin"=>"2",
                    "required"=>true,
                    "error"=>"Votre prénom doit faire entre 2 et 120 caractères",
                    "placeholder"=>"Votre prénom"
                ],
                "email"=>[
                    "type"=>"email",
                    "label"=>"Adresse Mail",
                    "lengthMax"=>"320",
                    "lengthMin"=>"8",
                    "required"=>true,
                    "error"=>"Votre email doit faire entre 8 et 320 caractères",
                    "placeholder"=>"Votre email"
                ],
                "pwd"=>[
                    "type"=>"password",
                    "label"=>"Mot de passe",
                    "lengthMin"=>"8",
                    "required"=>true,
                    "error"=>"Votre mot de passe doit faire plus de 8 caractères",
                    "placeholder"=>"Votre mot de passe"
                ],
                "pwdConfirm"=>[
                    "type"=>"password",
                    "label"=>"Confirmation de mot de passe",
                    "confirm"=>"pwd",
                    "required"=>true,
                    "error"=>"Votre mot de passe de confirmation est incorrect",
                    "placeholder"=>"Confirmation"
                ],
                "phone"=>[
                    "type"=>"text",
                    "label"=>"Numéro de téléphone",
                    "lengthMax"=>"10",
                    "lengthMin"=>"10",
                    "required"=>true,
                    "error"=>"Votre numéro de téléphone doit contenir 10 chiffres",
                    "placeholder"=>"Votre numéro de téléphone"
                ],
                "selectForm"=>[
                    "type"=>"select",
                    "label"=>"Rôle",
                    "required"=>true,
                    "error"=>"Veuillez sélectionner un élément",
                    "placeholder"=>"Choisir un rôle",
                    "options"=>[
                        "registered"=>[
                            "label" => "Inscrit",
                    ],
                        "create"=>[
                            "label" => "Crée",
                    ],
                ],

            ],
                "conditions"=>[
                    "type"=>"checkbox",
                    "required"=>false,
                    "options" => [
                        "acceptConditions" => [
                            "label" => "Envoyer un mail au nouvel utilisateur pour le prévenir de la création de son compte"
                        ]
                    ]
                ],
            ]

        ];
    }
}

