<?php
set_include_path('../');
require 'vendor/autoload.php';

include 'getPDO.php';

function getAllPosts()
{
    try {
        $pdo = getPDO();

        // SELECT title, img_url, content, username
        // FROM posts
        // INNER JOIN users ON posts.owner_id = users.id
        // ORDER BY posts.id DESC
        $posts = $pdo->select(array('title', 'img_url', 'content', 'username'))
            ->from('posts')
            ->join('users', 'posts.owner_id', '=', 'users.id')
            ->orderBy('posts.id', 'DESC')
            ->execute()
            ->fetchAll();
        return $posts;
    } catch (PDOException $e) {
        echo 'There was an error registering the account. Please try again.';
    }
}

getAllPosts();
class Posts
{

    public function getAllPost()
    {

    }

    public function addPost($title, $author, $text, $img)
    {

    }

    public function removePost($postID)
    {

    }

    public function editPost($id, $title, $img, $text)
    {

    }

}
