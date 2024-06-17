<?php

namespace Application\Controllers\ModifyComment;

require_once('src/lib/database.php');
require_once('src/model/comment.php');

use Application\Lib\Database\DatabaseConnection;
use Application\Model\Comment\Comment;
use Application\Model\Comment\CommentRepository;

class ModifyComment
{
    // saving modified comment
    public function execute(array $input, string $id, $post_id)
    {
        $author = null;
        $comment = null;
        if (!empty($input['author']) && !empty($input['comment'])) {
            $author = $input['author'];
            $comment = $input['comment'];
        } else {
            throw new \Exception('Les données du formulaire sont invalides.');
        }

        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();
        $success = $commentRepository->modifyComment($author, $comment, $id);
        if (!$success) {
            throw new \Exception('Impossible d\'ajouter le commentaire !');
        } else {
            header('Location: index.php?action=post&id='.$post_id );
        }
    }
    
    // viewing comment to modify
    public function sendOldComment($post_id, $id){
        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();
        $comments = $commentRepository->getComments( $post_id);
        if (!$comments) {
            throw new \Exception('Impossible d\'ajouter le commentaire !');
        } else {
            $comment = new Comment;
            foreach($comments as $comment)
            {
                if($comment->id == $id)
                {
                    $author= $comment->author;
                    $com= $comment->comment;
                }
            }
            if (isset($author)){
                require('templates/modify_comment.php');
            }
            else{
                throw new \Exception('Ce commentaire n\'existe pas');
            }
        }
    }
}
