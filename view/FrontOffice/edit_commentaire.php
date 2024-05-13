<?php

$idPost = $_GET['id'];
$idComment = $_GET['idComment'];

include_once "../../Controller/PostController.php";
include_once '../../Model/CommentaireModel.php';
include_once "../../Controller/CommentaireController.php";
$post = PostController::getPost($idPost);