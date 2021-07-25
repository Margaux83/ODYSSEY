<?php
namespace App\Models;

use App\Core\Database;
use App\Core\Helpers;
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

    public function __construct($idUser = null){
        parent::__construct();
        if(!empty($idUser)) {
            $this->setId($idUser);
        }
    }

    /**
     * @param $id
     * When an id is passed in parameter, we get the information of the corresponding user
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

    /**
     * @param $password
     * @param $passwordConfirm
     * @return bool
     * Function used to check that the password and the confirmation password passed in parameter are identical and that they are longer than 8 characters
     */
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

    /**
     * @param $email
     * @return bool
     * Function used to check that the email address passed in parameter does not already exist in the database
     */
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

    /**
     * @return array
     */
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
                "csrf"=>[
                    "type"=>"hidden",
                    "defaultValue"=>Helpers::generateCsrfToken()
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

    public function buildFormPassword() {
        return [
            "config" => [
                "method" => "POST",
                "action" => "/admin/password-change",
                "Submit" => "Changer le mot de passe",
                "class" => "form_register"
            ],
            "input" => [
                "csrf"=>[
                    "type"=>"hidden",
                    "defaultValue"=>Helpers::generateCsrfToken()
                ],
                "password"=> [
                    "type"=>"password",
                    "class"=>"requiredLabel",
                    "label"=>"Ancien mot de passe",
                    "lengthMax"=>"120",
                    "lengthMin"=>"8",
                    "required"=>true,
                    "error"=>"Votre mot de passe doit faire plus de 8 caractères",
                    "placeholder"=>"Votre ancien mot de passe"
                ],
                "new-password"=> [
                    "type"=>"password",
                    "class"=>"requiredLabel",
                    "label"=>"Nouveau mot de passe",
                    "lengthMax"=>"120",
                    "lengthMin"=>"8",
                    "required"=>true,
                    "error"=>"Votre nouveau mot de passe doit faire plus de 8 caractères",
                    "placeholder"=>"Votre nouveau mot de passe"
                ],
                "confirm-new-password"=> [
                    "type"=>"password",
                    "class"=>"requiredLabel",
                    "label"=>"Confirmer",
                    "lengthMax"=>"120",
                    "lengthMin"=>"8",
                    "required"=>true,
                    "error"=>"Votre confirmation de mot de passe doit faire plus de 8 caractères",
                    "placeholder"=>"Confirmer le nouveau mot de passe"
                ],
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
                "csrf"=>[
                    "type"=>"hidden",
                    "defaultValue"=>Helpers::generateCsrfToken()
                ],
                "login-email"=>[
                    "class"=>"requiredLabel",
                    "id"=>"login-email",
                    "type"=>"email",
                    "label"=>"Adresse Mail",
                    "lengthMin"=>"8",
                    "lengthMax"=>"320",
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
                "csrf"=>[
                    "type"=>"hidden",
                    "defaultValue"=>Helpers::generateCsrfToken()
                ],
                "lastname"=>[
                    "type"=>"text",
                    "label"=>"Nom",
                    "lengthMin"=>"2",
                    "lengthMax"=>"120",
                    "required"=>true,
                    "error"=>"Votre nom doit faire entre 2 et 120 caractères",
                    "placeholder"=>"Votre nom",
                    "defaultValue" => (empty($this->getLastname())) ? (empty($_POST['lastname'])) ? '' : $_POST['lastname'] : $this->getLastname()
                ],
                "firstname"=>[
                    "type"=>"text",
                    "class"=>"form_input",
                    "label"=>"Prénom",
                    "lengthMin"=>"2",
                    "lengthMax"=>"120",
                    "required"=>true,
                    "error"=>"Votre prénom doit faire entre 2 et 120 caractères",
                    "placeholder"=>"Votre prénom",
                    "defaultValue" => (empty($this->getFirstname())) ? (empty($_POST['firstname'])) ? '' : $_POST['firstname'] : $this->getFirstname()
                ],
                "email"=>[
                    "type"=>"email",
                    "label"=>"Adresse Mail",
                    "lengthMax"=>"320",
                    "lengthMin"=>"8",
                    "required"=>true,
                    "error"=>"Votre email doit faire entre 8 et 320 caractères",
                    "placeholder"=>"Votre email",
                    "defaultValue" => (empty($this->getEmail())) ? (empty($_POST['email'])) ? '' : $_POST['email'] : $this->getEmail()
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
                    "lengthMax"=>"10",
                    "required"=>true,
                    "error"=>"Votre numéro de téléphone doit contenir 10 chiffres",
                    "placeholder"=>"Votre numéro de téléphone",
                    "defaultValue" => (empty($this->getPhone())) ? (empty($_POST['phone'])) ? '' : $_POST['phone'] : $this->getPhone()
                ],
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
    public function buildFormResetPassword(){

        return [
            "config"=>[
                "method"=>"POST",
                "Action"=>"",
                "reset" => "Annuler",
                "Submit"=>"Envoyer",
                "class"=>"formElement"
            ],
            "input"=>[
                "csrf"=>[
                    "type"=>"hidden",
                    "defaultValue"=>Helpers::generateCsrfToken()
                ],
                "email"=>[
                    "class"=>"requiredLabel",
                    "id"=>"email",
                    "type"=>"email",
                    "label"=>"Adresse Mail",
                    "lengthMin"=>"8",
                    "lengthMax"=>"320",
                    "required"=>true,
                    "error"=>"Votre email doit faire entre 8 et 320 caractères",
                    "placeholder"=>"Votre email"
                ],
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
    public function buildFormToken(){

        return [
            "config"=>[
                "method"=>"POST",
                "Action"=>"",
                "reset" => "Annuler",
                "Submit"=>"Enregistrer",
                "class"=>"formElement"
            ],
            "input"=>[
                "csrf"=>[
                    "type"=>"hidden",
                    "defaultValue"=>Helpers::generateCsrfToken()
                ],
                "token"=>[
                    "class"=>"requiredLabel",
                    "id"=>"token",
                    "type"=>"text",
                    "label"=>"Token",
                    "lengthMin"=>"6",
                    "lengthMax"=>"6",
                    "required"=>true,
                    "error"=>"Votre token doit contenir 6 chiffres",
                    "placeholder"=> "",
                    "defaultValue" => isset($_GET['token']) ? $_GET['token'] : ""
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
    public function buildFormUser(){
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
                "csrf"=>[
                    "type"=>"hidden",
                    "defaultValue"=>Helpers::generateCsrfToken()
                ],
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
                    "defaultValue" => (empty($this->getLastname())) ? (empty($_POST['lastname'])) ? '' : $_POST['lastname'] : $this->getLastname()
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
                    "defaultValue" => (empty($this->getFirstname())) ? (empty($_POST['firstname'])) ? '' : $_POST['firstname'] : $this->getFirstname()
                ],
                "email"=>[
                    "type"=>"email",
                    "label"=>"Adresse Mail",
                    "lengthMax"=>"320",
                    "lengthMin"=>"8",
                    "required"=>true,
                    "error"=>"Votre email doit faire entre 8 et 320 caractères",
                    "placeholder"=>"Votre email",
                    "defaultValue" => (empty($this->getEmail())) ? (empty($_POST['email'])) ? '' : $_POST['email'] : $this->getEmail()
                ],
                "phone"=>[
                    "type"=>"text",
                    "label"=>"Numéro de téléphone",
                    "lengthMin"=>"10",
                    "lengthMax"=>"10",
                    "required"=>true,
                    "error"=>"Votre numéro de téléphone doit contenir 10 chiffres",
                    "placeholder"=>"Votre numéro de téléphone",
                    "defaultValue" => (empty($this->getPhone())) ? (empty($_POST['phone'])) ? '' : $_POST['phone'] : $this->getPhone()
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

    /**
     * @return array
     * Recovery of the information of the users which are not deleted and which will be able to be posted on the views
     */
    public function getAllUsers()
    {
        $results = $this->query(
            ["id", "firstname", "lastname", "email", "status", "role", "isVerified", "creationDate", "lastConnexionDate", "updateDate"],
            ["isDeleted" => "0"]
        );

        if (count($results)) {
            $role = new Role();
            foreach ($results as $key => $result) {
                if (!empty($result['role'])) {
                    $userSelected = $role->query(['name'], ['id' => $result['role']])[0];
                    $results[$key]['name'] = $userSelected['name'];
                }
            }
        }

        return $results;
    }
}