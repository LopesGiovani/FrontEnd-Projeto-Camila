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
   <title>Contas de Usuários</title>

   <!-- Font Awesome CDN link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- Custom CSS file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>

<body>

   <?php include '../components/admin_header.php' ?>

   <!-- Seção de contas de usuários começa aqui -->

   <section class="accounts">

      <h1 class="heading">Contas de Usuários</h1>

      <div class="box-container">

         <?php
         $select_account = $conn->prepare("SELECT * FROM `users`");
         $select_account->execute();
         if ($select_account->rowCount() > 0) {
            while ($fetch_accounts = $select_account->fetch(PDO::FETCH_ASSOC)) {
               $user_id = $fetch_accounts['id'];
               $count_user_comments = $conn->prepare("SELECT * FROM `comments` WHERE user_id = ?");
               $count_user_comments->execute([$user_id]);
               $total_user_comments = $count_user_comments->rowCount();
               $count_user_likes = $conn->prepare("SELECT * FROM `likes` WHERE user_id = ?");
               $count_user_likes->execute([$user_id]);
               $total_user_likes = $count_user_likes->rowCount();
               ?>
               <div class="box">
                  <p>ID do usuário: <span>
                        <?= $user_id; ?>
                     </span></p>
                  <p>Nome de usuário: <span>
                        <?= $fetch_accounts['name']; ?>
                     </span></p>
                  <p>Total de comentários: <span>
                        <?= $total_user_comments; ?>
                     </span></p>
                  <p>Total de curtidas: <span>
                        <?= $total_user_likes; ?>
                     </span></p>
               </div>
               <?php
            }
         } else {
            echo '<p class="empty">Nenhuma conta disponível</p>';
         }
         ?>

      </div>

   </section>

   <!-- Seção de contas de usuários termina aqui -->

   <!-- Arquivo JS personalizado link -->
   <script src="../js/admin_script.js"></script>

</body>

</html>