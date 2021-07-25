<?php


namespace App\Models;

use App\Core\Database;
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
     * Récupération des informations des commentaires qui ne sont pas supprimés et qui vont pouvoir être affichés sur les views et sur le front
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
                    $articleSelected = $article->query(['title'])[0];
                    $results[$key]['title'] = $articleSelected['title'];
                }
            }
        }

        return $results;
    }

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
                "content"=>[
                    "type"=>"text",
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
}