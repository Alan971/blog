<?php

require_once('src/controllers/add_comment.php');
require_once('src/controllers/modify_comment.php');
require_once('src/controllers/homepage.php');
require_once('src/controllers/post.php');

use Application\Controllers\AddComment\AddComment;
use Application\Controllers\ModifyComment\ModifyComment;

use Application\Controllers\Homepage\Homepage;
use Application\Controllers\Post\Post;

try {
    if (isset($_GET['action']) && $_GET['action'] !== '') {
        if ($_GET['action'] === 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $identifier = $_GET['id'];

                (new Post())->execute($identifier);
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif ($_GET['action'] === 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $identifier = $_GET['id'];

                (new AddComment())->execute($identifier, $_POST);
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }elseif ($_GET['action'] === 'modifyComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id = $_GET['id'];
                $post_id = $_GET['post_id'];

                (new ModifyComment())->sendOldComment($post_id, $id);
            }
        } elseif($_GET['action'] === 'viewNewComment'){
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $identifier = $_GET['id'];
                $post_id= $_GET['post_id'];
                (new ModifyComment())->execute($_POST, $identifier, $post_id);
            }
        } else {
            throw new Exception("La page que vous recherchez n'existe pas.");
        }
    } else {
        (new Homepage())->execute();
    }
} catch (Exception $e) {
    $errorMessage = $e->getMessage();

    require('templates/error.php');
}
