<?php
include '../components/connect.php';


session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:admin_login.php');
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Painel de Controle</title>

   <!-- Link para a biblioteca Font Awesome via CDN -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- Link para o arquivo CSS personalizado do administrador -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>

<body>

   <?php include '../components/admin_header.php' ?>

   <!-- Seção do painel de controle do administrador inicia aqui -->

   <section class="dashboard">

      <h1 class="heading">Painel de Controle</h1>

      <div class="box-container">

         <div class="box">
            <h3>Bem-vindo!</h3>
            <p>
               <?= $fetch_profile['name']; ?>
            </p>
            <a href="update_profile.php" class="btn">Atualizar Perfil</a>
         </div>

         <div class="box">
            <?php
            $select_posts = $conn->prepare("SELECT * FROM `posts` WHERE admin_id = ?");
            $select_posts->execute([$admin_id]);
            $numbers_of_posts = $select_posts->rowCount();
            ?>
            <h3>
               <?= $numbers_of_posts; ?>
            </h3>
            <p>posts adicionados</p>
            <a href="add_posts.php" class="btn">Adicionar novo post</a>
         </div>

         <div class="box">
            <?php
            $select_active_posts = $conn->prepare("SELECT * FROM `posts` WHERE admin_id = ? AND status = ?");
            $select_active_posts->execute([$admin_id, 'active']);
            $numbers_of_active_posts = $select_active_posts->rowCount();
            ?>
            <h3>
               <?= $numbers_of_active_posts; ?>
            </h3>
            <p>posts ativos</p>
            <a href="view_posts.php" class="btn">Ver posts</a>
         </div>

         <div class="box">
            <?php
            $select_deactive_posts = $conn->prepare("SELECT * FROM `posts` WHERE admin_id = ? AND status = ?");
            $select_deactive_posts->execute([$admin_id, 'deactive']);
            $numbers_of_deactive_posts = $select_deactive_posts->rowCount();
            ?>
            <h3>
               <?= $numbers_of_deactive_posts; ?>
            </h3>
            <p>posts inativos</p>
            <a href="view_posts.php" class="btn">Ver posts</a>
         </div>

         <div class="box">
            <?php
            $select_users = $conn->prepare("SELECT * FROM `users`");
            $select_users->execute();
            $numbers_of_users = $select_users->rowCount();
            ?>
            <h3>
               <?= $numbers_of_users; ?>
            </h3>
            <p>contas de usuários</p>
            <a href="users_accounts.php" class="btn">Ver usuários</a>
         </div>

         <div class="box">
            <?php
            $select_admins = $conn->prepare("SELECT * FROM `admin`");
            $select_admins->execute();
            $numbers_of_admins = $select_admins->rowCount();
            ?>
            <h3>
               <?= $numbers_of_admins; ?>
            </h3>
            <p>contas de administradores</p>
            <a href="admin_accounts.php" class="btn">Ver administradores</a>
         </div>

         <div class="box">
            <?php
            $select_comments = $conn->prepare("SELECT * FROM `comments` WHERE admin_id = ?");
            $select_comments->execute([$admin_id]);
            $numbers_of_comments = $select_comments->rowCount();
            ?>
            <h3>
               <?= $numbers_of_comments; ?>
            </h3>
            <p>comentários adicionados</p>
            <a href="comments.php" class="btn">Ver comentários</a>
         </div>

         <div class="box">
            <?php
            $select_likes = $conn->prepare("SELECT * FROM `likes` WHERE admin_id = ?");
            $select_likes->execute([$admin_id]);
            $numbers_of_likes = $select_likes->rowCount();
            ?>
            <h3>
               <?= $numbers_of_likes; ?>
            </h3>
            <p>total de curtidas</p>
            <a href="view_posts.php" class="btn">Ver posts</a>
         </div>

      </div>

   </section>

   <!-- Seção do painel de controle do administrador termina aqui -->

   <!-- Link para o arquivo JavaScript personalizado do administrador -->
   <script src="../js/admin_script.js"></script>

</body>

</html>