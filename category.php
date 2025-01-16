<?php
include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
}

include 'components/like_post.php';

// Certifique-se de definir $category mesmo se não estiver definido na URL
$category = isset($_GET['category']) ? $_GET['category'] : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Categoria</title>
   <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/png">


   <!-- Use the minified version files listed below for better performance and remove the files listed above -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
   <link rel="stylesheet" href="assets/css/vendor/vendor.min.css">
   <link rel="stylesheet" href="assets/css/plugins/plugins.min.css">
   <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

   <?php
   require_once("menu.php");
   ?>
   <!-- ...:::: Start Breadcrumb Section:::... -->
   <div class="breadcrumb-section breadcrumb-bg-color--golden" style="margin-top: -5%;">
      <div class="breadcrumb-wrapper">
         <div class="container">
            <div class="row">
               <div class="col-12">
                  <h4 class="title-category-user">
                     <?= $category; ?>
                     </h3>
                     <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">

                     </div>
               </div>
            </div>
         </div>
      </div>
   </div> <!-- ...:::: End Breadcrumb Section:::... -->
   <div class="blog-section">
      <div class="container">
         <div class="row">
            <div class="col-lg-12">
               <div class="blog-wrapper">
                  <div class="row mb-n6">
                     <?php
                     $select_posts = $conn->prepare("SELECT * FROM `posts` WHERE category = ? and status = ?");
                     $select_posts->execute([$category, 'active']);
                     if ($select_posts->rowCount() > 0) {
                        while ($fetch_posts = $select_posts->fetch(PDO::FETCH_ASSOC)) {

                           $post_id = $fetch_posts['id'];

                           $count_post_comments = $conn->prepare("SELECT * FROM `comments` WHERE post_id = ?");
                           $count_post_comments->execute([$post_id]);
                           $total_post_comments = $count_post_comments->rowCount();

                           $count_post_likes = $conn->prepare("SELECT * FROM `likes` WHERE post_id = ?");
                           $count_post_likes->execute([$post_id]);
                           $total_post_likes = $count_post_likes->rowCount();

                           $confirm_likes = $conn->prepare("SELECT * FROM `likes` WHERE user_id = ? AND post_id = ?");
                           $confirm_likes->execute([$user_id, $post_id]);
                           ?>

                           <div class="col-xl-4 col-md-6 col-12 mb-6">
                              <form>
                                 <div class="blog-list blog-grid-single-item blog-color--golden" data-aos="fade-up"
                                    data-aos-delay="0">
                                    <input type="hidden" name="post_id" value="<?= $post_id; ?>">
                                    <input type="hidden" name="admin_id" value="<?= $fetch_posts['admin_id']; ?>">
                                    <div class="image-box">
                                       <a href="blog-single-sidebar-left.php?post_id=<?= $post_id; ?>" class="image-link">
                                          <?php
                                          if ($fetch_posts['image'] != '') {
                                             ?>
                                             <img class="img-fluid" src="uploaded_img/<?= $fetch_posts['image']; ?>" alt="">
                                             <?php
                                          }
                                          ?>
                                       </a>
                                    </div>
                                    <div class="content">
                                       <ul class="post-meta">
                                          <li>Autor: <a href="author_posts.php?author=<?= $fetch_posts['name']; ?>">
                                                <?= $fetch_posts['name']; ?>
                                             </a>
                                          </li>
                                          <li>ON :
                                             <a href="#" class="date">
                                                <?= $fetch_posts['date']; ?>
                                             </a>
                                          </li>
                                       </ul>
                                       <h6 class="title">
                                          <a href="blog-single-sidebar-left.php?post_id=<?= $post_id; ?>">
                                             <?= $fetch_posts['title']; ?>
                                          </a>
                                       </h6>

                                       <a href="blog-single-sidebar-left.php?post_id=<?= $post_id; ?>"
                                          class="read-more-btn icon-space-left">Leia mais
                                          <span class="icon">
                                             <i class="ion-ios-arrow-thin-right"></i>
                                          </span>
                                       </a>
                                       <a href="category.php?category=<?= $fetch_posts['category']; ?>" class="post-cat">
                                          <i class="fas fa-tag"></i>
                                          <span>
                                             <?= $fetch_posts['category']; ?>
                                          </span>
                                       </a>
                                    </div>
                                 </div>
                              </form>
                           </div>
                           <?php
                        }
                     } else {
                        echo '<p class="empty">Nenhuma postagem encontrada para esta categoria!</p>';
                     }
                     ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>


   <!-- material-scrolltop button -->
   <button class="material-scrolltop" type="button"></button>

   <!-- ::::::::::::::All JS Files here :::::::::::::: -->
   <!-- Global Vendor, plugins JS -->
   <!-- <script src="assets/js/vendor/modernizr-3.11.2.min.js"></script>
<script src="assets/js/vendor/jquery-3.5.1.min.js"></script>
<script src="assets/js/vendor/jquery-migrate-3.3.0.min.js"></script>
<script src="assets/js/vendor/popper.min.js"></script>
<script src="assets/js/vendor/bootstrap.min.js"></script>
<script src="assets/js/vendor/jquery-ui.min.js"></script>  -->

   <!--Plugins JS-->
   <!-- <script src="assets/js/plugins/swiper-bundle.min.js"></script>
<script src="assets/js/plugins/material-scrolltop.js"></script>
<script src="assets/js/plugins/jquery.nice-select.min.js"></script>
<script src="assets/js/plugins/jquery.zoom.min.js"></script>
<script src="assets/js/plugins/venobox.min.js"></script>
<script src="assets/js/plugins/jquery.waypoints.js"></script>
<script src="assets/js/plugins/jquery.lineProgressbar.js"></script>
<script src="assets/js/plugins/aos.min.js"></script>
<script src="assets/js/plugins/jquery.instagramFeed.js"></script>
<script src="assets/js/plugins/ajax-mail.js"></script> -->

   <!-- Use the minified version files listed below for better performance and remove the files listed above -->
   <script src="assets/js/vendor/vendor.min.js"></script>
   <script src="assets/js/plugins/plugins.min.js"></script>

   <!-- Main JS -->
   <br>
   <br>
   <br>
   <br>

   <script src="assets/js/main.js"></script>
   <?php
   require_once("footer.php");
   ?>
</body>