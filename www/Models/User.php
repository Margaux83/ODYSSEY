<?php
namespace App\Models;

use App\Core\Database;
use App\Models\Role;

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
    protected $updateDate;
    protected $token;
    protected $isVerified;

    /**
     * User constructor.
     */
    public function __construct($idUser = null){
        parent::__construct();
        if(!empty($idUser)) {
            $this->setId($idUser);
        }
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
     * @return $password
     */
    public function setPassword($password){
        $this->password = $password;
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
     * @param $updateDate
     */
    public function setUpdateDate($updateDate)
    {
        $this->updateDate = $updateDate;
    }

    /**
     * @return mixed
     */
    public function getUpdateDate()
    {
        return $this->updateDate;
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

    public function verifyPassword($password, $passwordConfirm){
        if($password !== $passwordConfirm) {
            $_SESSION['alert']['danger'][] = 'Les deux mots de passe ne correspondent pas';
            header('location: /register');
            session_write_close();
            return false;
        }elseif(strlen($password) < 8) {
            $_SESSION['alert']['danger'][] = 'Votre mot de passe doit faire plus de 8 caractères';
            header('location: /register');
            session_write_close();
            return false;
        } else {
            return true;
        }
    }

    public function verifyEmail($email){
        $db = new Database("User");
        $result = $db->query(
            ["id"],
            ["email" => $email]
        );
        if(!$result) {
            return true;
        } else {
            $_SESSION['alert']['danger'][] = 'L\'adresse email existe déjà';
            header('location: /register');
            session_write_close();
            return false;
        }
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
            ],
            "button"=>[
                "class"=>"buttonComponent d-flex floatRight",
                "name"=>""
            ]
        ];
    }

    /**
     * @return array
     */
    public function buildFormLogin(){

        return [
            "config"=>[
                "method"=>"POST",
                "Action"=>"",
                "reset" => "Annuler",
                "Submit"=>"Se connecter",
                "class"=>"formElement"
            ],
            "input"=>[
                "login-email"=>[
                    "class"=>"requiredLabel",
                    "id"=>"login-email",
                    "type"=>"email",
                    "label"=>"Adresse Mail",
                    "lengthMax"=>"320",
                    "lengthMin"=>"8",
                    "required"=>true,
                    "error"=>"Votre email doit faire entre 8 et 320 caractères",
                    "placeholder"=>"Votre email"
                ],
                "login-pwd"=>[
                    "class"=>"requiredLabel",
                    "type"=>"password",
                    "id"=>"login-pwd",
                    "label"=>"Mot de passe",
                    "lengthMin"=>"8",
                    "required"=>true,
                    "error"=>"Votre mot de passe doit faire plus de 8 caractères",
                    "placeholder"=>"Votre mot de passe"
                ]
            ],
            "button"=>[
                "class"=>"primary",
                "name"=>""
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
                "password-confirm"=>[
                    "type"=>"password",
                    "label"=>"Confirmation du mot de passe",
                    "lengthMin"=>"8",
                    "required"=>true,
                    "error"=>"Votre mot de passe doit faire plus de 8 caractères",
                    "placeholder"=>"Votre mot de passe"
                ],
                "phone"=>[
                    "type"=>"text",
                    "label"=>"Numéro de téléphone",
                    "lengthMin"=>"10",
                    "required"=>true,
                    "error"=>"Votre numéro de téléphone doit contenir 10 chiffres",
                    "placeholder"=>"Votre numéro de téléphone"
                ],
            ],
            "button"=>[
                "class"=>"primary",
                "name"=>""
            ]

        ];
    }

    public function buildFormRegisterBack(){
        $role = new Role();

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
                "role"=>[
                    "type"=>"select",
                    "label"=>"Rôle",
                    "required"=>true,
                    "error"=>"Veuillez sélectionner un élément",
                    "placeholder"=>"Choisir un rôle",
                    "options"=> $role->buildAllRolesFormSelect($this->role)
                ]
            ],
            "button"=>[
                "class"=>"buttonComponent d-flex floatRight",
                "name"=>""
            ]
        ];
    }

    public function buildFormUpdateBack(){
        $role = new Role();

        return [
            "config"=>[
                "method"=>"POST",
                "Action"=>"users",
                "reset" => "Annuler",
                "Submit"=>"Enregistrer",
                "class"=>"form-group"

            ],
            "input"=>[
                "id_user"=>[
                    "type"=>"hidden",
                    "defaultValue"=>$this->getId()
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
                "firstname"=>[
                    "type"=>"text",
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
                    "readonly"=>true,
                    "error"=>"Votre email doit faire entre 8 et 320 caractères",
                    "placeholder"=>"Votre email",
                    "defaultValue" => $this->getEmail()
                ],
                "phone"=>[
                    "type"=>"text",
                    "label"=>"Numéro de téléphone",
                    "lengthMax"=>"10",
                    "required"=>true,
                    "error"=>"Votre numéro de téléphone doit contenir 10 chiffres",
                    "placeholder"=>"Votre numéro de téléphone",
                    "defaultValue" => $this->getPhone()
                ],
                "role"=>[
                    "type"=>"select",
                    "label"=>"Rôle",
                    "required"=>true,
                    "error"=>"Veuillez sélectionner un élément",
                    "placeholder"=>"Choisir un rôle",
                    "options"=>
                        $role->buildAllRolesFormSelect($this->role)

                ],
            ],
            "button"=>[
                "class"=>"buttonComponent d-flex floatRight",
                "name"=>""
            ]
        ];
    }

    public function getAllUsers()
    {
        $results = $this->query(
            ["id", "firstname", "lastname", "email", "status", "role", "creationDate", "lastConnexionDate"],
            ["isDeleted" => "0"]
        );

        if (count($results)) {
            $role = new Role();
            foreach ($results as $key => $result) {
                if (!empty($result['role'])) {
                    $userSelected = $role->query(['name'])[0];
                    $results[$key]['name'] = $userSelected['name'];
                }
            }
        }

        return $results;
    }
}