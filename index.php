<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}
;

?>

<!DOCTYPE html>
<html lang="pt-br">


<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Apresentação</title>

    <!-- ::::::::::::::Favicon icon::::::::::::::-->
    <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/png">

    <!-- ::::::::::::::All CSS Files here :::::::::::::: -->
    <!-- Vendor CSS -->
    <!-- <link rel="stylesheet" href="assets/css/vendor/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/vendor/ionicons.css">
    <link rel="stylesheet" href="assets/css/vendor/simple-line-icons.css">
    <link rel="stylesheet" href="assets/css/vendor/jquery-ui.min.css"> -->

    <!-- Plugin CSS -->
    <!-- <link rel="stylesheet" href="assets/css/plugins/swiper-bundle.min.css">
    <link rel="stylesheet" href="assets/css/plugins/animate.min.css">
    <link rel="stylesheet" href="assets/css/plugins/nice-select.css">
    <link rel="stylesheet" href="assets/css/plugins/venobox.min.css">
    <link rel="stylesheet" href="assets/css/plugins/jquery.lineProgressbar.css">
    <link rel="stylesheet" href="assets/css/plugins/aos.min.css"> -->

    <!-- Main CSS -->
    <!-- <link rel="stylesheet" href="assets/sass/style.css"> -->

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

    <!-- Start Hero Slider Section-->
    <div class="hero-slider-section " data-aos="fade-up" data-aos-delay="250">
        <!-- Slider main container -->
        <div class="hero-slider-active swiper-container">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Start Hero Single Slider Item -->
                <div class="hero-single-slider-item swiper-slide">
                    <!-- Hero Slider Image -->
                    <div class="hero-slider-bg">
                        <img src="assets/images/hero-slider/home-1/hero-slider-1.jpg" alt="">
                    </div>
                    <!-- Hero Slider Content -->
                    <div class="hero-slider-wrapper">
                        <div class="container">
                            <div class="row-index">
                                <div class="col-auto">
                                    <div class="hero-slider-content">
                                        <h4 class="subtitle">Centro de Documentação <br>Virtual</h4>
                                        <h2 class="title">São João Evangelista</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- End Hero Single Slider Item -->
                <!-- Start Hero Single Slider Item -->

            </div>



        </div>
    </div>
    <!-- End Hero Slider Section-->
    <div>
        <!-- Start Service Section -->
        <div class="service-promo-section section-top-gap-100">
            <div class="service-wrapper">
                <div class="container">
                    <div class="row">
                        <!-- Start Service Promo Single Item -->
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="service-promo-single-item" data-aos="fade-up" data-aos-delay="0">
                                <div class="image">
                                    <img src="assets/images/icons/historia-caneta.png" alt="">
                                </div>
                                <div class="content">
                                    <h6 class="title">História</h6>
                                    <!-- <p>Get 10% cash back, free shipping, free returns, and more at 1000+ top retailers!</p> -->
                                </div>
                            </div>
                        </div>
                        <!-- End Service Promo Single Item -->

                        <!-- Start Service Promo Single Item -->
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="service-promo-single-item" data-aos="fade-up" data-aos-delay="200">
                                <div class="image">
                                    <img src="assets/images/icons/mascara-africana.png" alt="">
                                </div>
                                <div class="content">
                                    <h6 class="title">Cultura</h6>
                                    <!-- <p>100% satisfaction guaranteed, or get your money back within 30 days!</p> -->
                                </div>
                            </div>
                        </div>
                        <!-- End Service Promo Single Item -->

                        <!-- Start Service Promo Single Item -->
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="service-promo-single-item" data-aos="fade-up" data-aos-delay="400">
                                <div class="image">
                                    <img src="assets/images/icons/comunidade.png" alt="">
                                </div>
                                <div class="content">
                                    <h6 class="title">Sociedade</h6>
                                    <!-- <p>Pay with the world’s most popular and secure payment methods.</p> -->
                                </div>
                            </div>
                        </div>
                        <!-- End Service Promo Single Item -->
                    </div>
                </div>
            </div>

        </div>
        <div class="carousel-container" data-aos="fade-up" data-aos-delay="200">
            <i class="arrow fas fa-chevron-left arrow-left"></i>
            <div class="carousel-content">
                <div class="carousel-item">
                    <div class="carousel-title">Chegada a São João Evangelista</div>
                    <div class="carousel-paragraph">
                        Quando cheguei à São João Evangelista em abril de 2022, tive a estranha sensação de que a
                        história da cidade parecia restrita a algumas poucas famílias consideradas relevantes por grande
                        parte da população. O ofício do historiador, contudo, desconfia dos silêncios e sabe que onde
                        eles reinam é por que muito há para ser extraído.
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="carousel-title">Prospeção de Fontes e Descobertas</div>
                    <div class="carousel-paragraph">
                        Para tanto, eu me vali do projeto de extensão desenvolvido no decorrer da minha experiência como
                        professora visitante do Instituto Federal de Minas Gerais. Iniciei a prospecção de fontes no
                        Arquivo Público Mineiro, que revelou São João Evangelista como uma cidade devotada a registrar
                        edificações e personalidades políticas, o que também se confirmou à medida que conversava com as
                        pessoas no município.
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="carousel-title">Aspectos Peculiares da História Local</div>
                    <div class="carousel-paragraph">
                        Por meio, contudo, de um detalhe aqui, uma fala acolá, fui percebendo aspectos peculiares da
                        história local: a influência indígena em tradições populares, a relação ambivalente com a antiga
                        Escola Agrícola, hoje IFMG, a presença de uma vida cultural pulsante em outras décadas que se
                        perdeu com o tempo. Observei ainda uma confusão entre o público e o privado, que converte fontes
                        de interesse público e importantíssimas para a memória local em acervo nas mãos de poucos,
                        dificultando tanto o acesso de pessoas comuns quanto de pesquisadores, inclusive para efeitos de
                        divulgação, como é o caso do presente projeto de extensão.
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="carousel-title">Construção do Site e Resultados</div>
                    <div class="carousel-paragraph">
                        O site em questão, assim, é fruto de um ano e oito meses de trabalho junto ao campus São João
                        Evangelista, período este em que foi coordenado por mim e contou com a dedicação de discentes do
                        Ensino Médio Técnico e da graduação. Somando habilidades e esforços, nos empenhamos em
                        entrevistar moradores e localizar toda a sorte de registros que pudessem nos orientar a respeito
                        da história de São João Evangelista. Todo o material obtido foi disponibilizado neste site,
                        convertido em uma espécie de centro de memória virtual, visando levar ao grande público e a
                        possíveis interessados material de informação e de pesquisa sobre as diferentes conexões com o
                        passado da cidade.
                    </div>
                </div>
            </div>
            <i class="arrow fas fa-chevron-right arrow-right"></i>
        </div>
    </div>

    <!-- End Service Section -->



    <!-- End Blog Slider Section -->
    <?php
    require_once("footer.php");
    ?>

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
    <script src="assets/js/main.js"></script>
</body>



</html>