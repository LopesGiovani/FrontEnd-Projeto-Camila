<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:admin_login.php');
}

if (isset($_POST['publish'])) {

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $title = $_POST['title'];
   $title = filter_var($title, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $content = $_POST['content'];
   $content = filter_var($content, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $category = $_POST['category'];
   $category = filter_var($category, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $status = 'active';

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../uploaded_img/' . $image;

   $file = $_FILES['file']['name'];
   $file = filter_var($file, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $file_size = $_FILES['file']['size'];
   $file_tmp_name = $_FILES['file']['tmp_name'];
   $file_folder = '../uploaded_file/' . $file;

   $select_image = $conn->prepare("SELECT * FROM `posts` WHERE image = ? AND admin_id = ?");
   $select_image->execute([$image, $admin_id]);

   if (isset($image)) {
      if ($select_image->rowCount() > 0 and $image != '') {
         $message[] = 'nome da imagem repetido!';
      } elseif ($image_size > 5000000) {
         $message[] = 'tamanho da imagem é muito grande!';
      } else {
         move_uploaded_file($image_tmp_name, $image_folder);
      }
   } else {
      $image = '';
   }

   if ($select_image->rowCount() > 0 and $image != '') {
      $message[] = 'por favor, renomeie sua imagem!';
   }

   $select_file = $conn->prepare("SELECT * FROM `posts` WHERE file = ? AND admin_id = ?");
   $select_file->execute([$file, $admin_id]);

   if (isset($file)) {
      if ($select_file->rowCount() > 0 and $file != '') {
         $message[] = 'nome do arquivo repetido!';
      } elseif ($file_size > 5000000) {
         $message[] = 'tamanho do arquivo é muito grande!';
      } else {
         move_uploaded_file($file_tmp_name, $file_folder);
      }
   } else {
      $file = '';
   }

   if ($select_file->rowCount() > 0 and $file != '') {
      $message[] = 'por favor, renomeie seu arquivo!';
   } else {
      $insert_post = $conn->prepare("INSERT INTO `posts`(admin_id, name, title, content, category, image, file, status) VALUES(?,?,?,?,?,?,?,?)");
      $insert_post->execute([$admin_id, $name, $title, $content, $category, $image, $file, $status]);
      $message[] = 'postagem publicada!';
   }
}

if (isset($_POST['publish'])) {

   // Verifique se um arquivo foi selecionado
   if (!empty($image)) {
      // Verifique se o arquivo é uma imagem (opcional)
      $allowed_extensions = array('jpg', 'jpeg', 'png', 'webp');
      $file_extension = pathinfo($image, PATHINFO_EXTENSION);
      if (!in_array(strtolower($file_extension), $allowed_extensions)) {

      } elseif ($image_size > 5000000) { // Verifique o tamanho máximo
         $message[] = 'O tamanho da imagem é muito grande (máximo de 2MB permitido).';
      } else {
         // Move o arquivo para o diretório de destino
         move_uploaded_file($image_tmp_name, $image_folder);
      }
   } else {
      $image = '';
   }

   if (!empty($file)) {
      // Verifique o tamanho máximo do arquivo (ajuste conforme necessário)
      if ($file_size > 50000000) { // 50MB
         $message[] = 'O tamanho do arquivo é muito grande (máximo de 50MB permitido).';
      } else {
         move_uploaded_file($file_tmp_name, $file_folder);
      }
   }
}

if (isset($_POST['draft'])) {

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $title = $_POST['title'];
   $title = filter_var($title, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $content = $_POST['content'];
   $content = filter_var($content, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $category = $_POST['category'];
   $category = filter_var($category, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $status = 'deactive';

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../uploaded_img/' . $image;

   $select_image = $conn->prepare("SELECT * FROM `posts` WHERE image = ? AND admin_id = ?");
   $select_image->execute([$image, $admin_id]);

   if (isset($image)) {
      if ($select_image->rowCount() > 0 and $image != '') {
         $message[] = 'nome da imagem repetido!';
      } elseif ($image_size > 2000000) {
         $message[] = 'tamanho da imagem é muito grande!';
      } else {
         move_uploaded_file($image_tmp_name, $image_folder);
      }
   } else {
      $image = '';
   }

   if ($select_image->rowCount() > 0 and $image != '') {
      $message[] = 'por favor, renomeie sua imagem!';
   } else {
      $insert_post = $conn->prepare("INSERT INTO `posts`(admin_id, name, title, content, category, image, status) VALUES(?,?,?,?,?,?,?)");
      $insert_post->execute([$admin_id, $name, $title, $content, $category, $image, $status]);
      $message[] = 'rascunho salvo!';
   }
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

   <section class="post-editor">

      <h1 class="heading">Adicionar nova postagem</h1>

      <form action="" method="post" enctype="multipart/form-data">
         <input type="hidden" name="name" value="<?= $fetch_profile['name']; ?>">
         <p>Título da postagem <span>*</span></p>
         <input type="text" name="title" maxlength="100" required placeholder="Adicione o título da postagem"
            class="box">
         <p>Conteúdo da postagem <span>*</span></p>
         <textarea name="content" class="box" required maxlength="10000" placeholder="Escreva seu conteúdo..." cols="30"
            rows="10"></textarea>
         <p>Categoria da postagem <span>*</span></p>
         <select name="category" class="box" required>
            <option value="" selected disabled>-- Selecione a categoria* </option>
            <option value="fotos">Fotos</option>
            <option value="manuscritos">Manuscritos</option>
            <option value="jornais">Jornais</option>
            <option value="historia-oral">História Oral</option>
            <option value="historia-local">História Local</option>
         </select>
         <p>Imagem da postagem</p>
         <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp">
         <p>Arquivo da postagem</p>
         <input type="file" name="file" class="box">

         <div class="flex-btn">
            <input type="submit" value="Publicar postagem" name="publish" class="btn">
            <input type="submit" value="Salvar rascunho" name="draft" class="option-btn">
         </div>
      </form>

   </section>

   <!-- Custom JS file link  -->
   <script src="../js/admin_script.js"></script>

</body>

</html>