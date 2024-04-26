<!DOCTYPE html>
<html>
<body>

<head>
  <title>Main Page</title>
  <meta charset="utf-8" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />

    <!-- Latest compiled and minified Bootstrap 4.6 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <!-- CSS script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="css/example.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abel&display=swap" rel="stylesheet">
    <!-- Latest Font-Awesome CDN -->
    <script src="https://kit.fontawesome.com/83a2a6ffac.js" crossorigin="anonymous"></script>


</head>

<header class="navbar">
        <a class="navbar-brand text-uppercase text-dark" href="">
            <img class="logo-menu" src="images/logo2.png" alt="Logo" />
            <!-- <span class="ml-2 font-weight-bold">MNT ADMIN PANEL</span> -->
        </a>
        <div class="header-left">
            <a class="active" href="#home">Main Page</a>
            <a class="active" href="#contact">Premiers</a>
            <a class="active" href="#about">Buy ticket</a>
        </div>
        <div class="header-right">
            <button class="rightone">Register</button>
            <button class="righttwo">Log in</button>
            <!-- <p class="right">Register</p>
            <a class="right" href="logout.php" role="button">Log in</a> -->
        </div>
</header>




<section class="theater-background">
        <!-- Theater background image -->
        <img src="https://images.ctfassets.net/6pezt69ih962/1O40LqsEvLqXzhEluBRbzH/df5c7bc9f6f151c28d9fc484bb13451b/DL_house.jpeg" alt="Theater Background" class="img-fluid" style="width: 100%; height: auto;">
        <!-- <div class="theater-overlay">
            <h1 class="text-center text-light">Discover the Best Movies and Performances</h1>
        </div> -->
    </section>

  <div class="filter">
    <button class="filter_button">Filter</button>
  </div>

  <div class="popular">
    <p>Most popular</p>
  </div>

    <div class="row1">
      <div id="show1">
        <img class="duh" src="https://mnt.mk/media/k2/items/cache/fe77b047cf65bbf66915926fa3c00c93_L.jpg"/>
        <button class="24april">24 April, 19:30</button>
        <button class="age1">12+</button>
      </div>
      <div id="show2">
        <img class="kec na desetka" src="https://mnt.mk/media/k2/items/cache/2940b97ab5721a9e279f736f864f4ce6_L.jpg"/>
        <button class="20may">20 May, 18:00</button>
        <button class="age2">18+</button>
      </div>
      <div id="show3">
        <img class="nicija zemja" src="https://mnt.mk/media/k2/items/cache/e1479c60fc7d7f4f708d42f869f837c8_L.jpg"/>
        <button class="26april">26 April, 19:00</button>
        <button class="age3">12+</button>
      </div>
    </div>

    <div class="row2">
      <div id="show4">
        <img class="agava" src="https://mnt.mk/media/k2/items/cache/5467774f5535dc0e0bd116e89a59b7ab_L.jpg"/>
        <button class="2may">2 May 19:30</button>
        <button class="age4">12+</button>
      </div>
      <div id="show5">
        <img class="toronto express" src="https://mnt.mk/media/k2/items/cache/013018afcf84fd53ed1be7bac0415c88_L.jpg"/>
        <button class="10may">10 May, 18:00</button>
        <button class="age5">18+</button>
      </div>
      <div id="show6">
        <img class="nema da bide kraj na svetot" src="https://mnt.mk/media/k2/items/cache/da388805d72915b428bc7670a13b37e3_L.jpg"/>
        <button class="16april">16 April, 19:00</button>
        <button class="age6">19+</button>
      </div>
    </div>


</body>
</html>