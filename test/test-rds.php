<?php
  include '../classes/getPDO.php';
  $pdo = getPDO();
  var_dump($pdo);
  echo '<br>';
  echo '<br>';

  $users = $pdo->select()
      ->from('users')
      ->execute()
      ->fetchAll();

  var_dump($users);
  echo '<br>';
  echo '<br>';

  $posts = $pdo->select()
      ->from('posts')
      ->execute()
      ->fetchAll();

  var_dump($posts);
  echo '<br>';
  echo '<br>';

  $follows = $pdo->select()
      ->from('follows')
      ->execute()
      ->fetchAll();

  var_dump($follows);
?>