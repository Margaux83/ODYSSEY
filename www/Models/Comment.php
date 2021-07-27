<?php


namespace App\Models;

use App\Core\Database;
use App\Core\Helpers;
use App\Models\User;
use App\Models\Article;


class Comment extends Database
{
    protected $id=null;
    protected $content;
    protected $id_Article;
    protected $id_User;
    protected $id_Comment;
    protected $isDeleted;
    protected $isVerified;

    /**
     * @param $id
     */
    public function setId($id){
        $this->id = $id;
    }

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }



    /**
     * @param $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param $isdeleted
     */
    public function setIsDeleted($isDeleted)
    {
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
     * @param $id_Article
     */
    public function setId_Article($id_Article)
    {
        $this->id_Article = $id_Article;
    }

    public function getId_Article()
    {
        return $this->id_Article;
    }

    /**
     * @param mixed $id_user
     */
    public function setId_User($id_User)
    {
        $this->id_User = $id_User;
    }

    /**
     * @return mixed
     */
    public function getId_User()
    {
        return $this->id_User;
    }

    /**
     * @param mixed $id_comment
     */
    public function setId_Comment($id_Comment)
    {
        $this->id_Comment = $id_Comment;
    }

    /**
     * @return mixed
     */
    public function getId_Comment()
    {
        return $this->id_Comment;
    }

    public function getIsVerified() {
        return $this->isVerified;
    }
    public function setIsVerified($isVerified) {
        $this->isVerified = $isVerified;
    }

    /**
     * @return array
     * Recovering information from comments that are not deleted and that can be displayed on the views and on the front
     **/
    public function getAllComments()
    {
        $results = $this->query(
            ['id', 'content', 'creationDate', 'updateDate', 'isVerified', 'id_User', 'id_Article'],
            ['isDeleted' => 0]
        );

        if (count($results)) {
            $user = new User();
            $article = new Article();
            foreach ($results as $key => $result) {
                if (!empty($result['id_User'])) {
                    $userSelected = $user->query(['firstname', 'lastname'], ['id' => $result['id_User']])[0];
                    $results[$key]['lastname'] = $userSelected['lastname'];
                    $results[$key]['firstname'] = $userSelected['firstname'];
                }
                if (!empty($result['id_Article'])) {
                    $articleSelected = $article->query(['title'],['id' => $result['id_Article']])[0];
                    $results[$key]['title'] = $articleSelected['title'];
                }
            }
        }

        return $results;
    }

    /**
     * @param $idArticle
     * @return array
     */
    public function buildFormPostFront($idArticle)
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "actionfront/postcommentfront",
                "Submit" => "Commenter",
                "class" => "ody_frontForm"
            ],
            "input" => [
                "csrf"=>[
                    "type"=>"hidden",
                    "defaultValue"=>Helpers::generateCsrfToken()
                ],
                "content"=>[
                    "type"=>"textarea",
                    "label"=>"Contenu",
                    "required"=>false,
                    "placeholder"=>"Ecrivez votre commentaire"
                ],
                "id_Article"=>[
                    "type"=>"hidden",
                    "defaultValue" => $idArticle
                ]
            ]
        ];
    }

    /**
     * @param $idArticle
     * @return array
     */
    public function buildFormPostFrontNotConnected($idArticle)
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "actionfront/postcommentfrontnotconnected",
                "Submit" => "Commenter",
                "class" => "ody_frontForm"
            ],
            "input" => [
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
                ],
                "email"=>[
                    "type"=>"email",
                    "label"=>"Adresse Mail",
                    "lengthMax"=>"320",
                    "lengthMin"=>"8",
                    "required"=>true,
                    "error"=>"Votre email doit faire entre 8 et 320 caractères",
                    "placeholder"=>"Votre email",
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
                    "label"=>"Confirmation",
                    "lengthMin"=>"8",
                    "required"=>true,
                    "error"=>"Votre mot de passe doit faire plus de 8 caractères",
                    "placeholder"=>"Votre mot de passe"
                ],
                "phone"=>[
                    "type"=>"text",
                    "label"=>"Téléphone",
                    "lengthMin"=>"10",
                    "lengthMax"=>"10",
                    "required"=>true,
                    "error"=>"Votre numéro de téléphone doit contenir 10 chiffres",
                    "placeholder"=>"Votre numéro de téléphone",
                ],
                "content"=>[
                    "type"=>"textarea",
                    "label"=>"Contenu",
                    "required"=>true,
                    "placeholder"=>"Ecrivez votre commentaire"
                ],
                "id_Article"=>[
                    "type"=>"hidden",
                    "defaultValue" => $idArticle
                ]
            ]
        ];
    }
}