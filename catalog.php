<?php require_once("Main.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>1000 Дрібниць </title>



  <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,700" rel="stylesheet">

  <link rel="stylesheet" href="assets/css/bootstrap/bootstrap.css">
  <link rel="stylesheet" href="assets/css/animate.css">
  <link rel="stylesheet" href="assets/fonts/ionicons/css/ionicons.min.css">

  <link rel="stylesheet" href="assets/css/owl.carousel.min.css">

  <link rel="stylesheet" href="assets/fonts/flaticon/font/flaticon.css">

  <link rel="stylesheet" href="assets/fonts/fontawesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/bootstrap-datepicker.css">
  <link rel="stylesheet" href="assets/css/select2.css">


  <link rel="stylesheet" href="assets/css/helpers.css">
  <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

  <!--NAV bar-->
  <nav class="navbar navbar-expand-lg navbar-dark probootstrap_navbar" id="probootstrap-navbar">
    <div class="container">
      <a class="navbar-brand" href="/">1000 Дрібниць</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#probootstrap-menu"
        aria-controls="probootstrap-menu" aria-expanded="false" aria-label="Toggle navigation">
        <span><i class="ion-navicon"></i></span>
      </button>
      <div class="collapse navbar-collapse" id="probootstrap-menu">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item"><a class="nav-link" href="index.php">Головна сторінка</a></li>
          <li class="nav-item active"><a class="nav-link" href="catalog.php">Каталог товарів</a></li>
          <li class="nav-item"><a class="nav-link" href="">Виробники</a></li>
          <li class="nav-item"><a class="nav-link" href="">Акції</a></li>
          <li class="nav-item"><a class="nav-link" href="">Контакти</a></li>
          <li class="nav-item"><a class="nav-link" href="cabinet.php"><i class="fa fa-user-o" aria-hidden="true"></i>
              Кабінет</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- END nav -->

  <!--Photo section -->
  <section class="probootstrap-cover overflow-hidden relative" style="background-image: url('assets/images/head.jpg');"
    data-stellar-background-ratio="0.5" id="section-home">
    <div class="overlay"></div>
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md">
          <h2 class="heading mb-2 display-4 font-light probootstrap-animate fadeInUp probootstrap-animated">Обирайте те
            що припаде до душі</h2>
          <p class="lead mb-5 probootstrap-animate fadeInUp probootstrap-animated">


          </p>

          <p></p>
        </div>

      </div>
    </div>

  </section>
  <!-- END section -->


  <section class="probootstrap_section" id="section-feature-testimonial">
    <div class="container">


    </div>
  </section>
  <!-- END section -->

  <section class="probootstrap_section" id="section-city-guides">
    <div class="container">
      <div class="row text-center mb-5 probootstrap-animate fadeInUp probootstrap-animated">
        <div class="col-md-12">
          <h2 class="display-4 border-bottom probootstrap-section-heading">Каталог товарів</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 probootstrap-animate fadeInUp probootstrap-animated">
          <label>Категорія товару</label>
          <select onchange="location = this.value" class="form-control" name="category">
            <option>Виберіть категорію</option>
            <?php outCategoryInSelect() ?>
          </select>
        </div>
        <div class="col-md-6 probootstrap-animate fadeInUp probootstrap-animated">
          <label>Сортування</label>
          <select onchange="location =  this.value" value="" name="sort" class="form-control">
            <option value="catalog.php?<?php echo http_build_query(array_merge($_GET, ["sort" => "name"])); ?>">Сортувати
              за</option>
            <option value="catalog.php?<?php echo http_build_query(array_merge($_GET, ["sort" => "price ASC"])); ?>">Від
              най дешевших</option>
            <option value="catalog.php?<?php echo http_build_query(array_merge($_GET, ["sort" => "price DESC"])); ?>">Від
              най дорожчих</option>
            <option value="catalog.php?<?php echo http_build_query(array_merge($_GET, ["sort" => "name ASC"])); ?>">Від А
              до Я</option>
            <option value="catalog.php?<?php echo http_build_query(array_merge($_GET, ["sort" => "name DESC"])); ?>">Від Я
              до А</option>
          </select>
        </div>
      </div>
      <br>
      <div class="row">



        <?php outAllProduct((isset($_GET["category"])) ? $_GET["category"] : "", (isset($_GET["sort"])) ? $_GET["sort"] : "name"); ?>
      </div>
    </div>
  </section>



  <footer class="probootstrap_section probootstrap-border-top">
    <div class="container">
      <div class="row mb-12 text-center">
        <div class="col-md-12">
          <h3 class="probootstrap_font-18 mb-3">Швидкі посилання</h3>
          <ul class="list-unstyled">
            <li><a href="index.php" target="_blank">Головна сторінка</a></li>
            <li><a href="catalog.php" target="_blank">Каталог товарів</a></li>
            <li><a href="" target="_blank">Виробники</a></li>
            <li><a href="" target="_blank">Акції</a></li>
            <li><a href="" target="_blank">Контакти</a></li>
          </ul>
        </div>

      </div>
      <div class="row pt-5">
        <div class="col-md-12 text-center">
          <p class="probootstrap_font-14">&copy; 2017. All Rights Reserved. <br> Designed &amp; Developed by <a href=""
              target="_blank">SKR SKR</a></p>

        </div>
      </div>
    </div>
  </footer>


  <script src="assets/js/jquery.min.js"></script>

  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/owl.carousel.min.js"></script>

  <script src="assets/js/bootstrap-datepicker.js"></script>
  <script src="assets/js/jquery.waypoints.min.js"></script>
  <script src="assets/js/jquery.easing.1.3.js"></script>

  <script src="assets/js/select2.min.js"></script>

  <script src="assets/js/main.js"></script>
</body>

</html>