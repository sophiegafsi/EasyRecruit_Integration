<?php
include_once '../../Model/PostModel.php';
include_once "../../Controller/PostController.php";


//$posts = PostController::getPosts();
$newPost = new PostModel( "Test", "Test", 1);
$id = PostController::addPost($newPost);
echo $id;