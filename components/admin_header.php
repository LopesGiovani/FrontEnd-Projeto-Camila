<?php
if (isset($message)) {
   foreach ($message as $message) {
      echo '
      <div class="message">
         <span>' . $message . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

   <a href="dashboard.php" class="logo">Admin<span>Panel</span></a>

   <div class="profile">
      <?php
      $select_profile = $conn->prepare("SELECT * FROM `admin` WHERE id = ?");
      $select_profile->execute([$admin_id]);
      $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
      ?>
      <p>
         <?= $fetch_profile['name']; ?>
      </p>
      <a href="update_profile.php" class="btn">Atualizar Perfil</a>
   </div>

   <nav class="navbar">
      <a href="dashboard.php"><i class="fas fa-home"></i> <span>início</span></a>
      <a href="add_posts.php"><i class="fas fa-pen"></i> <span>adicionar posts</span></a>
      <a href="view_posts.php"><i class="fas fa-eye"></i> <span>ver posts</span></a>
      <a href="admin_accounts.php"><i class="fas fa-user"></i> <span>contas</span></a>
      <a href="../index.php" style="color:var(--red);" onclick="return confirm('Sair do site?');"><i
            class="fas fa-right-from-bracket"></i><span>sair</span></a>
   </nav>

   <div class="flex-btn">
      <a href="admin_login.php" class="option-btn">login</a>
      <a href="register_admin.php" class="option-btn">registrar</a>
   </div>

</header>

<div id="menu-btn" class="fas fa-bars"></div>