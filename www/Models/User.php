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
    protected $token;
    protected $isVerified;

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
        $db = new Database("User");
        $result = $db->query(
            ["id"],
            ["email" => $email]
        );
        if(!$result) {
            $this->email = $email;
        } else {
            $_SESSION['alert']['danger'][] = 'L\'adresse email existe déjà';
            header('location: /register');
            session_write_close();
        }
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return $password
     */
    public function setPassword($password){
        $this->password = $password;
    }

    public function verifyPassword($password, $passwordConfirm){
        if($password !== $passwordConfirm) {
            $_SESSION['alert']['danger'][] = 'Les deux mots de passe ne correspondent pas';
            header('location: /register');
            session_write_close();
        }elseif(count($password) < 8) {
            $_SESSION['alert']['danger'][] = 'Votre mot de passe doit faire plus de 8 caractères';
            header('location: /register');
            session_write_close();
        } else {
            return true;
        }
    }

    public function getPassword()
    {
        return $this->password;
    }

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

    /**
     * @param $role
     */
    public function setToken($token){
        $this->token = $token;
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param $role
     */
    public function setIsVerified($isVerified){
        $this->isVerified = $isVerified;
    }

    /**
     * @return mixed
     */
    public function getIsVerified()
    {
        return $this->isVerified;
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
                "reset" => "Annuler",
                "Submit"=>"Enregistrer",
                "class"=>"formElement"
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
                    "class"=>"form_input",
                    "label"=>"Prénom",
                    "lengthMax"=>"120",
                    "lengthMin"=>"2",
                    "required"=>true,
                    "error"=>"Votre prénom doit faire entre 2 et 120 caractères",
                    "placeholder"=>"Votre prénom",
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
            ]

        ];
    }

    public function buildFormRegisterBack(){
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
                    "class"=>"form_input",
                    "label"=>"Prénom",
                    "lengthMax"=>"120",
                    "lengthMin"=>"2",
                    "required"=>true,
                    "error"=>"Votre prénom doit faire entre 2 et 120 caractères",
                    "placeholder"=>"Votre prénom",
                    "defaultValue" => $this->getFirstname()
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
                "phone"=>[
                    "type"=>"text",
                    "label"=>"Numéro de téléphone",
                    "lengthMin"=>"10",
                    "required"=>true,
                    "error"=>"Votre numéro de téléphone doit contenir 10 chiffres",
                    "placeholder"=>"Votre numéro de téléphone"
                ],
            ]

        ];
    }

    public function buildFormUpdateBack(){
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
            ]

        ];
    }

}