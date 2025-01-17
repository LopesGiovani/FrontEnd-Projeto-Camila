<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:admin_login.php');
}

if (isset($_POST['delete'])) {

   $p_id = $_POST['post_id'];
   $p_id = filter_var($p_id, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

   // Preparando a consulta para buscar o post
   $delete_image = $conn->prepare("SELECT * FROM `posts` WHERE id = ?");
   $delete_image->execute([$p_id]);
   $fetch_delete_image = $delete_image->fetch(PDO::FETCH_ASSOC);

if ($fetch_delete_image['image'] != '') {
    $image_path = '../uploaded_img/' . $fetch_delete_image['image'];
    
    // Verifique o caminho do arquivo
    var_dump($image_path);  // Exibe o caminho completo para o arquivo
    
    if (file_exists($image_path)) {
        unlink($image_path);
        echo "Arquivo excluído: " . $image_path;
    } else {
        echo "O arquivo não foi encontrado: " . $image_path;
    }
}

   // Apagar a imagem da pasta 'uploaded_img'
   if ($fetch_delete_image['image'] != '') {
      $image_path = '../uploaded_img/' . $fetch_delete_image['image'];
      if (file_exists($image_path)) {
         unlink($image_path);
      }
   }

   // Apagar o arquivo da pasta 'uploaded_file' (se existir)
   if ($fetch_delete_image['file'] != '') {
      $file_path = '../uploaded_file/' . $fetch_delete_image['file'];
      if (file_exists($file_path)) {
         unlink($file_path);
      }
   }

   // Apagar o post do banco de dados
   $delete_post = $conn->prepare("DELETE FROM `posts` WHERE id = ?");
   $delete_post->execute([$p_id]);

   // Apagar os comentários relacionados ao post
   $delete_comments = $conn->prepare("DELETE FROM `comments` WHERE post_id = ?");
   $delete_comments->execute([$p_id]);

   $message[] = 'Post deleted successfully!';
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

   <section class="show-posts">

      <h1 class="heading">Suas postagens</h1>

      <div class="box-container">

         <?php
         $select_posts = $conn->prepare("SELECT * FROM `posts` WHERE admin_id = ?");
         $select_posts->execute([$admin_id]);
         if ($select_posts->rowCount() > 0) {
            while ($fetch_posts = $select_posts->fetch(PDO::FETCH_ASSOC)) {
               $post_id = $fetch_posts['id'];

               $count_post_comments = $conn->prepare("SELECT * FROM `comments` WHERE post_id = ?");
               $count_post_comments->execute([$post_id]);
               $total_post_comments = $count_post_comments->rowCount();

               $count_post_likes = $conn->prepare("SELECT * FROM `likes` WHERE post_id = ?");
               $count_post_likes->execute([$post_id]);
               $total_post_likes = $count_post_likes->rowCount();

               ?>
               <form method="post" class="box">
                  <input type="hidden" name="post_id" value="<?= $post_id; ?>">
                  <?php if ($fetch_posts['image'] != '') { ?>
                     <img src="../uploaded_img/<?= $fetch_posts['image']; ?>" class="image" alt="">
                  <?php } ?>
                  <div class="status" style="background-color:<?php if ($fetch_posts['status'] == 'active') {
                     echo 'limegreen';
                  } else {
                     echo 'coral';
                  }
                  ; ?>;">
                     <?= $fetch_posts['status']; ?>
                  </div>
                  <div class="title">
                     <?= $fetch_posts['title']; ?>
                  </div>
                  <div class="posts-content">
                     <?= $fetch_posts['content']; ?>
                  </div>
                  <div class="icons">
                     <div class="likes"><i class="fas fa-heart"></i><span>
                           <?= $total_post_likes; ?>
                        </span></div>
                     <div class="comments"><i class="fas fa-comment"></i><span>
                           <?= $total_post_comments; ?>
                        </span></div>
                  </div>
                  <div class="flex-btn">
                     <a href="edit_post.php?id=<?= $post_id; ?>" class="option-btn">editar</a>
                     <button type="submit" name="delete" class="delete-btn"
                        onclick="return confirm('excluir esta postagem?');">excluir</button>
                  </div>
                  <a href="read_post.php?post_id=<?= $post_id; ?>" class="btn">ver postagem</a>
               </form>
               <?php
            }
         } else {
            echo '<p class="empty">ainda não foram adicionadas postagens! <a href="add_posts.php" class="btn" style="margin-top:1.5rem;">adicionar postagem</a></p>';
         }
         ?>

      </div>

   </section>

   <!-- Custom JS file link  -->
   <script src="../js/admin_script.js"></script>

</body>

</html>
