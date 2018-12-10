<?php
set_include_path('../');
require 'vendor/autoload.php';

include 'getPDO.php';



class Posts
{
    public function getAllPosts()
    {
        try {
            $pdo = getPDO();

            // SELECT title, img_url, content, username
            // FROM posts
            // INNER JOIN users ON posts.owner_id = users.id
            // ORDER BY posts.id DESC
            $posts = $pdo->select(array('posts.id','title', 'img_url', 'content', 'username'))
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

    public function getUserPosts($username) {
        try {
            $pdo = getPDO();

            // SELECT title, img_url, content, username
            // FROM posts
            // INNER JOIN users ON posts.owner_id = users.id
            // ORDER BY posts.id DESC
            $posts = $pdo->select(array('posts.id','title', 'img_url', 'content', 'username'))
                ->from('posts')
                ->join('users', 'posts.owner_id', '=', 'users.id')
                ->where('username', '=', $username)
                ->orderBy('posts.id', 'DESC')
                ->execute()
                ->fetchAll();
            return $posts;
        } catch (PDOException $e) {
            echo 'There was an error registering the account. Please try again.';
        }
    }

    public function addPost($title, $author, $text, $img)
    {
      // INSERT INTO users ( id , usr , pwd ) VALUES ( ? , ? , ? )
      $insertStatement = $GLOBALS['pdo']->insert(array('title', 'img_url', 'content', 'owner_id'))
                             ->into('posts')
                             ->values(array($title, $img, $text, $author));

      $insertId = $insertStatement->execute(false);
      return $insertID;
    }

    public function getPost($postID)
    {
      // SELECT * FROM users WHERE id = ?
      $selectStatement = $GLOBALS['pdo']->select()
                             ->from('posts')
                             ->where('id', '=', $postID);

      $stmt = $selectStatement->execute();
      $data = $stmt->fetch();
      return $data;
    }

    public function removePost($postID)
    {

    }

    public function editPost($id, $title, $img, $text)
    {
      // UPDATE users SET pwd = ? WHERE id = ?
      $updateStatement = $GLOBALS['pdo']->update(array('title' => $title,'img_url' => $img,'content' => $text))
                             ->table('posts')
                             ->where('id', '=', $id);

      $affectedRows = $updateStatement->execute();
    }

}
