<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:admin_login.php');
}

$get_id = $_GET['post_id'];

if (isset($_POST['delete'])) {

   $p_id = $_POST['post_id'];
   $p_id = filter_var($p_id, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $delete_image = $conn->prepare("SELECT * FROM `posts` WHERE id = ?");
   $delete_image->execute([$p_id]);
   $fetch_delete_image = $delete_image->fetch(PDO::FETCH_ASSOC);
   if ($fetch_delete_image['image'] != '') {
      unlink('../uploaded_img/' . $fetch_delete_image['image']);
   }
   $delete_post = $conn->prepare("DELETE FROM `posts` WHERE id = ?");
   $delete_post->execute([$p_id]);
   $delete_comments = $conn->prepare("DELETE FROM `comments` WHERE post_id = ?");
   $delete_comments->execute([$p_id]);
   header('location:view_posts.php');

}

if (isset($_POST['delete_comment'])) {

   $comment_id = $_POST['comment_id'];
   $comment_id = filter_var($comment_id, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $delete_comment = $conn->prepare("DELETE FROM `comments` WHERE id = ?");
   $delete_comment->execute([$comment_id]);
   $message[] = 'Comentário excluído!';

}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Posts</title>

   <!-- Font Awesome CDN link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- Custom CSS file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>

<body>

   <?php include '../components/admin_header.php' ?>

   <section class="read-post">

      <?php
      $select_posts = $conn->prepare("SELECT * FROM `posts` WHERE admin_id = ? AND id = ?");
      $select_posts->execute([$admin_id, $get_id]);
      if ($select_posts->rowCount() > 0) {
         while ($fetch_posts = $select_posts->fetch(PDO::FETCH_ASSOC)) {
            $post_id = $fetch_posts['id'];
            $file_name = $fetch_posts['file'];

            $count_post_comments = $conn->prepare("SELECT * FROM `comments` WHERE post_id = ?");
            $count_post_comments->execute([$post_id]);
            $total_post_comments = $count_post_comments->rowCount();

            $count_post_likes = $conn->prepare("SELECT * FROM `likes` WHERE post_id = ?");
            $count_post_likes->execute([$post_id]);
            $total_post_likes = $count_post_likes->rowCount();



            ?>

            <form method="post">
               <input type="hidden" name="post_id" value="<?= $post_id; ?>">
               <div class="status" style="background-color:<?php if ($fetch_posts['status'] == 'active') {
                  echo 'limegreen';
               } else {
                  echo 'coral';
               }
               ; ?>;">
                  <?= $fetch_posts['status']; ?>
               </div>
               <?php if ($fetch_posts['image'] != '') { ?>
                  <img src="../uploaded_img/<?= $fetch_posts['image']; ?>" class="image" alt="">
               <?php } ?>
               <div class="title">
                  <?= $fetch_posts['title']; ?>
               </div>
               <div class="content">
                  <?= $fetch_posts['content']; ?>
               </div>

               <?php if (!empty($file_name)) { ?>
                  <a href="../uploaded_file/<?= $file_name; ?>" class="download-link" download>Download do Arquivo</a>
               <?php } ?>

               <div class="icons">
                  <div class="likes"><i class="fas fa-heart"></i><span>
                        <?= $total_post_likes; ?>
                     </span></div>
                  <div class="comments"><i class="fas fa-comment"></i><span>
                        <?= $total_post_comments; ?>
                     </span></div>
               </div>
               <div class="flex-btn">



                  <a href="edit_post.php?id=<?= $post_id; ?>" class="inline-option-btn">editar</a>
                  <button type="submit" name="delete" class="inline-delete-btn"
                     onclick="return confirm('Excluir este post?');">excluir</button>
                  <a href="view_posts.php" class="inline-option-btn">voltar</a>
               </div>
            </form>
            <?php
         }
      } else {
         echo '<p class="empty">Nenhum post adicionado ainda! <a href="add_posts.php" class="btn" style="margin-top:1.5rem;">adicionar post</a></p>';
      }
      ?>



   </section>

   <section class="comments" style="padding-top: 0;">

      <p class="comment-title">Comentários do Post</p>
      <div class="box-container">
         <?php
         $select_comments = $conn->prepare("SELECT * FROM `comments` WHERE post_id = ?");
         $select_comments->execute([$get_id]);
         if ($select_comments->rowCount() > 0) {
            while ($fetch_comments = $select_comments->fetch(PDO::FETCH_ASSOC)) {
               ?>
               <div class="box">
                  <div class="user">
                     <i class="fas fa-user"></i>
                     <div class="user-info">
                        <span>
                           <?= $fetch_comments['user_name']; ?>
                        </span>
                        <div>
                           <?= $fetch_comments['date']; ?>
                        </div>
                     </div>
                  </div>
                  <div class="text">
                     <?= $fetch_comments['comment']; ?>
                  </div>
                  <form action="" method="POST">
                     <input type="hidden" name="comment_id" value="<?= $fetch_comments['id']; ?>">
                     <button type="submit" class="inline-delete-btn" name="delete_comment"
                        onclick="return confirm('Excluir este comentário?');">excluir comentário</button>
                  </form>
               </div>
               <?php
            }
         } else {
            echo '<p class="empty">Nenhum comentário adicionado ainda!</p>';
         }
         ?>
      </div>

   </section>









   <!-- custom js file link  -->
   <script src="../js/admin_script.js"></script>

</body>

</html>