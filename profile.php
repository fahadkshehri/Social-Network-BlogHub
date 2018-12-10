<?php
include 'classes/profiles.php';
include 'classes/posts.php';
include 'post_preview.php';

session_start();
$profiles = new Profiles();
$posts = new Posts();

$username = $_GET['username'];
$profile = $profiles->getProfile($username);

?>
<!DOCTYPE html>
<html>
  <? include 'head.php'; ?>
  <body>
    <? include 'menu.php'; ?>

    <div class='container p-5'>
      <?
        if (!$profile) {
          header("Location: 404notfound.php");
          die();
        } else {
          ?>
          <div class='border p-4 mb-4'>
            <div class='d-flex flex-row mb-4'>
              <img class='profile-picture mr-4' src='https://s3-us-west-2.amazonaws.com/bloghub-profilepics/<?=$profile['img']['S']?>' />

              <h2><?=$profile['profileName']['S'] ?> </h2>


            </div>
            <a class='btn btn-dark' href='edit-profile.php?username=<?=$username?>'>Edit Profile</a>
          </div>

          <h2>Posts:</h2>
          <?
            $userPosts = $posts->getUserPosts($username);
            foreach ($userPosts as $post) {
              echo_post_preview($post['id'], $post['title'], $post['username'], $post['content']);
            }
        }
      ?>

    </div>

  </body>
</html>
