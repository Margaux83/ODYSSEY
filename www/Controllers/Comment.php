<?php


namespace App;
use App\Core\Security;
use App\Core\View;
use App\Models\Comment as ModelComment;
use App\Models\Article;

class Comment
{

    /**
     * Display the list of saved and undeleted comments in the database
     * Verification of the comment by an administrator
     */
    public function defaultAction()
    {

        $security = Security::getInstance();
        if(!$security->isConnected()){
            header('Location: /login');
        }
       $comments = new ModelComment;
        $allComments = $comments->getAllComments();

        $view = new View("Comment/comment", "back");
        $view->assign("allComments", Helpers::cleanArray($allComments));


        if (!empty($_POST)) {
            $comments->verify($_POST['id_comment']);
        }
    }

    /**
     * Add a comment from the front, on the page of an article
     */
    public function postCommentFromFrontAction() {
        $selectedArticle = null;

        if (!empty($_POST)) {
            $comment = new ModelComment;
            if (!empty($_POST['content']) && !empty($_POST['id_Article'])) {
                $comment->setContent($_POST['content']);
                $comment->setId_Article($_POST['id_Article']);
                $comment->setId_User($_SESSION["userId"]);
                $comment->setIsDeleted(0);
                $comment->setIsVerified(0);
                $comment->save();
            }

            if (!empty($_POST['id_Article'])) {
                $article = new Article();
                $selectedArticle = $article->query(['uri'], ['id' => $_POST['id_Article']]);

                if (count($selectedArticle)) {
                    header('Location: ' . $selectedArticle[0]['uri']);
                }else {
                    header('Location: /');
                }
            }else {
                header('Location: /');
            }
        }
    }

    /**
     * Deleting a comment using its Id
     */
    public function deleteCommentAction() {
        $category = new ModelComment();

        if (!empty($_POST)) {
            if (!empty($_POST['deleteComment'])) {
                $category->delete($_POST['id_comment']);
            }
        }
    }
}