<?php


namespace App\Models;

use App\Core\Database;
use App\Core\Helpers;
use App\Core\Form;

class Article extends Database
{

    protected $id;
    protected $title;
    protected $content;
    protected $isvisible;
    protected $category;
    protected $description;
    protected $isdeleted;
    protected $id_user;
    protected $uri;

    public function __construct(){
        parent::__construct();
    }

    public function getID()
    {
        return $this->id;
    }

    /**
     * @param $id
     * When an id is passed in parameter, we get the information of the corresponding article
     */
    public function setId($id){
        $this->id = $id;

        $data = array_diff_key(
            get_object_vars($this),
            get_class_vars(get_parent_class())
        );
        unset($data["category"]);
        $columns = array_keys($data);
        $statement = $this->pdo->prepare("SELECT " . implode(',', $columns) . " FROM ".$this->table." WHERE id=:id");
        $statement->execute(array(":id" => $this->getId()));

       $obj = $statement->fetchObject(__CLASS__);
       $this->setArticleFromObj($obj);

        $this->searchCategory();
    }

    private function setArticleFromObj($obj){
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
     * @param $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
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
        return stripslashes($this->content);
    }

    /**
     * @param $isvisible
     */
    public function setIsvisible($isvisible)
    {
        $this->isvisible = $isvisible;
    }

    /**
     * @return mixed
     */
    public function getIsvisible()
    {
        return $this->isvisible;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param $isdeleted
     */
    public function setIsdeleted($isdeleted)
    {
        $this->isdeleted = $isdeleted;
    }

    /**
     * @return mixed
     */
    public function getIsdeleted()
    {
        return $this->isdeleted;
    }

    /**
     * @param $id_user
     */
    public function setId_user($id_user)
    {
        $this->id_user = $id_user;
    }

    /**
     * @return mixed
     */
    public function getId_user()
    {
        return $this->id_user;
    }

    /**
     * @return mixed
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @param mixed $uri
     */
    public function setUri($uri)
    {
        $this->uri = $uri;
    }

    public function get_foreignKeys()
    {
        return ['category'];
    }

    /**
     * Function that allows you to build the options of the item's status select
     **/
    public function searchCategory() {
        $categoryArticle = new Category_Article();
        $resultCategory = $categoryArticle->query(['id_category'], ['id_article' => $this->getId()])[0];
        $this->setCategory($resultCategory['id_category']);
    }


    /**
     * Function that allows you to build the options of the article's status select
     **/
    public function buildAllStatusFormSelect() {
        $status = [
            '' => [
                "label" => "Choisir un status"
            ],
            "1"=>[
                "label" => "Brouillon",
            ],
            "2"=>[
                "label" => "Créé",
            ],
            "3"=>[
                "label" => "En attente de validation"
            ],
            "4"=>[
                "label" => "Validé et posté"
            ]
        ];

        $returnedArray = [];

        foreach ($status as $key => $singleStatus) {
            $returnedArray[$key] = [
                'label' => $singleStatus['label'],
                'selected' => $key === $this->getStatus()
            ];
        }

        return $returnedArray;
    }

    /**
     * @return array
     */
    public function buildFormArticle()
    {
        $category = new Category();
        $form = new Form();
        return [
            "config"=>[
                "method"=>"POST",
                "Action"=>"",
                "Submit"=>"Publier",
                "class"=>"",
            ],

            "input"=>[
                "csrf"=>[
                    "type"=>"hidden",
                    "defaultValue"=>Helpers::generateCsrfToken()
                ],
                "id"=>[
                    "type"=>"hidden",
                    "required"=>true,
                    "defaultValue"=>$this->getID()
                ],
                "title"=>[

                    "type"=>"text",
                    "label"=>"Veuillez choisir un titre pour votre article",
                    "lengthMax"=>"255",
                    "lengthMin"=>"2",
                    "required"=>true,
                    "error"=>"Le titre de l'article doit faire entre 2 et 255 caractères",
                    "placeholder"=>"Votre titre",

                    "defaultValue"=> (empty($this->getTitle())) ? (empty($_POST['title'])) ? '' : $_POST['title'] : $this->getTitle()
                ],
                "uri"=>[

                    "type"=>"text",
                    "label"=>"Veuillez choisir une uri pour votre article",
                    "lengthMax"=>"255",
                    "lengthMin"=>"2",
                    "required"=>true,
                    "class"=>"input",
                    "error"=>"L'uri l'article doit faire entre 2 et 255 caractères",
                    "placeholder"=>"Votre uri",
                    "defaultValue"=> (empty(substr($this->getUri(), 9))) ? (empty($_POST['uri'])) ? '' : $_POST['uri'] : substr($this->getUri(), 9)
                ],
                    "content"=>[
                        "type"=>"textarea",
                        "label"=>"",
                        "lengthMin"=>"2",
                        "error"=>"Le contenu de l'article doit faire entre 2 et 255 caractères",
                        "id"=>"full-featured-non-premium",
                        "placeholder"=>"Votre contenu",
                        "defaultValue"=> (empty($this->getContent())) ? (empty($_POST['content'])) ? '' : $_POST['content'] : $this->getContent()
                    ],
                    "description"=>[
                        "type"=>"textarea",
                        "label"=>"Description (SEO)",
                        "lengthMin"=>"2",
                        "lengthMax"=>"150",
                        "error"=>"Le contenu de votre description doit faire entre 2 et 150 caractères",
                        "id"=>"content",
                        "required"=>true,
                        "class"=>"textareaComment d-flex",
                        "placeholder"=>"Votre contenu",
                        "defaultValue"=> (empty($this->getDescription())) ? (empty($_POST['description'])) ? '' : $_POST['description'] : $this->getDescription()
                    ],
                    "category"=>[
                        "type"=>"select",
                        "label"=>"Catégorie",
                        "required"=>true,
                        "error"=>"Veuillez sélectionner un élément",
                        "placeholder"=>"Choisir une catégorie",
                        "options"=>
                            $category->buildAllCategoriesFormSelect($this->category)

                    ],
                    "isvisible"=>[
                        "type"=>"select",
                        "label"=>"Visibilité",
                        "required"=>true,
                        "error"=>"Veuillez sélectionner un élément",
                        "placeholder"=>"Choisir une visibilité",
                        "options"=>$form->buildAllVisibilityFormSelect($this)
                    ],

                ],
            "button"=>[
                "class"=>"buttonComponent d-flex floatRight",
                "name"=>"insert_article"
            ]

        ];
    }


    /**
     * @param null $id_user
     * @return array
     * Recovery of the information of the articles which are not deleted and which will be able to be posted on the views
     */
    public function getAllArticles($id_user = null): array
    {
        $filter["isDeleted"] = "0";
        if(!empty($id_user)) {
            $filter["id_User"] = $id_user;
        }
        $results = Article::query(
            ["id" ,"uri", "title", "content", "description", "isVisible", "creationDate", "updateDate", "isDeleted", "id_User"],
            $filter
        );
        if (count($results)) {
            $user = new User();
            $category_article = new Category_Article();
            $category = new Category();
            // INNER JOIN ON TABLE ody_user
            foreach ($results as $key => $result) {
                if (!empty($result['id_User'])) {
                    $userSelected = $user->query(['firstname', 'lastname'], ['id' => $result['id_User']])[0];
                    $results[$key]['firstname'] = $userSelected['firstname'];
                    $results[$key]['lastname'] = $userSelected['lastname'];
                }
            }
            // DOUBLE JOIN ON TABLE ody_Category_Article and ody_Category
            foreach ($results as $key => $result) {
                $results_category = $category_article->query(
                    ["id_Category"],
                    ["id_Article" => $results[$key]['id']]
                );
                foreach($results_category as $result2) {
                    if (!empty($result2["id_Category"])) {
                        $categorySelected = $category->query(['label'], ['id' => $result2['id_Category']])[0];
                        $results[$key]['label'] = $categorySelected['label'];
                    }
                }
            }
        }
        return $results;
    }


    /**
     * @param $id
     * @param $uri
     * @return array
     * Returns the uri of an item if it already exists in the database
     */
    public function getUriForVerification($id,$uri)
    {
        return Article::query(
            ["uri"],
            ["isDeleted" => "0", "uri" => $uri, "!id" => $id]
        );
    }

    /**
     * @param $id
     * @param $id_category
     * Update the category of an article
     */
    public function updateCategoryOfArticle($id, $id_category)
    {
        $query = $this->pdo->prepare("UPDATE ody_Category_Article SET id_Category=".$id_category." WHERE id_Article=" . $id);
        $query->execute();
    }

    /**
     * @param $category
     * @param $id_Article
     * Save the category id and the article id in the intermediate table ody_Category_Article
     */
    public function saveArticleCategory($category,$id_Article)
    {
        $category_article = new Category_Article();
        $category_article->setIdCategory($category);
        $category_article->setIdArticle($id_Article);
        $category_article->save();
    }
}