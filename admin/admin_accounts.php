<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:admin_login.php');
}

if (isset($_POST['delete'])) {
   $delete_image = $conn->prepare("SELECT * FROM `posts` WHERE admin_id = ?");
   $delete_image->execute([$admin_id]);
   while ($fetch_delete_image = $delete_image->fetch(PDO::FETCH_ASSOC)) {
      unlink('../uploaded_img/' . $fetch_delete_image['image']);
   }
   $delete_posts = $conn->prepare("DELETE FROM `posts` WHERE admin_id = ?");
   $delete_posts->execute([$admin_id]);
   $delete_likes = $conn->prepare("DELETE FROM `likes` WHERE admin_id = ?");
   $delete_likes->execute([$admin_id]);
   $delete_comments = $conn->prepare("DELETE FROM `comments` WHERE admin_id = ?");
   $delete_comments->execute([$admin_id]);
   $delete_admin = $conn->prepare("DELETE FROM `admin` WHERE id = ?");
   $delete_admin->execute([$admin_id]);
   header('location:../components/admin_logout.php');
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Contas de Administradores</title>

   <!-- Font Awesome CDN link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- Custom CSS file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>

<body>

   <?php include '../components/admin_header.php' ?>

   <!-- Seção de contas de administradores começa aqui -->

   <section class="accounts">

      <h1 class="heading">Contas de Administradores</h1>

      <div class="box-container">

         <div class="box" style="order: -2;">
            <p>Registrar novo administrador</p>
            <a href="register_admin.php" class="option-btn" style="margin-bottom: .5rem;">Registrar</a>
         </div>

         <?php
         $select_account = $conn->prepare("SELECT * FROM `admin`");
         $select_account->execute();
         if ($select_account->rowCount() > 0) {
            while ($fetch_accounts = $select_account->fetch(PDO::FETCH_ASSOC)) {

               $count_admin_posts = $conn->prepare("SELECT * FROM `posts` WHERE admin_id = ?");
               $count_admin_posts->execute([$fetch_accounts['id']]);
               $total_admin_posts = $count_admin_posts->rowCount();

               ?>
               <div class="box" style="order: <?php if ($fetch_accounts['id'] == $admin_id) {
                  echo '-1';
               } ?>;">
                  <p>ID do administrador: <span>
                        <?= $fetch_accounts['id']; ?>
                     </span></p>
                  <p>Nome de usuário: <span>
                        <?= $fetch_accounts['name']; ?>
                     </span></p>
                  <p>Total de postagens: <span>
                        <?= $total_admin_posts; ?>
                     </span></p>
                  <div class="flex-btn">
                     <?php
                     if ($fetch_accounts['id'] == $admin_id) {
                        ?>
                        <a href="update_profile.php" class="option-btn" style="margin-bottom: .5rem;">Atualizar</a>
                        <form action="" method="POST">
                           <input type="hidden" name="post_id" value="<?= $fetch_accounts['id']; ?>" on>
                           <button type="submit" name="delete" onclick="return confirm('Excluir a conta?');" class="delete-btn"
                              style="margin-bottom: .5rem;">Excluir</button>
                        </form>
                        <?php
                     }
                     ?>
                  </div>
               </div>
               <?php
            }
         } else {
            echo '<p class="empty">Nenhuma conta disponível</p>';
         }
         ?>

      </div>

   </section>

   <!-- Seção de contas de administradores termina aqui -->

   <!-- Arquivo JS personalizado link -->
   <script src="../js/admin_script.js"></script>

</body>

</html>