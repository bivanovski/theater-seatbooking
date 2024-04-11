<?php
// session_start(); // Commented out for Visual Studio
// require_once('Books/Book.php');

// use Books\Book as Book;

// require_once('Categories/Category.php');

// use Categories\Category as Category;

// if (isset($_SESSION['username']) && $_SESSION['role'] === "admin") {
//   return header('Location: login.php?errorMessage=Unauthorized');
// }
// $book = new Book();
// $books = $book->get();
// $category = new Category();
// $categories = $category->get();
?>

<!DOCTYPE html>
<html>

<head>
  <title>Main Page</title>
  <meta charset="utf-8" />
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />

  <!-- Latest compiled and minified Bootstrap 4.6 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />
  <!-- CSS script -->
  <link rel="stylesheet" href="style.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Outfit&family=Roboto&display=swap" rel="stylesheet" />

  <!-- Latest Font-Awesome CDN -->
  <script src="https://kit.fontawesome.com/83a2a6ffac.js" crossorigin="anonymous"></script>
</head>

<!--/.Navbar-->

<header class="fixed-top">
  <nav class="navbar bg-1 shadow ">
    <a class="navbar-brand text-center text-uppercase font-weight-bold text-dark" href="index.php"><img
        class="logo-menu w-75 d-block img-fluid mx-auto" src="./logo2.png" alt="Logo" />Library</a>

    <div class="form-inline">
      <?php
      if (!isset($_SESSION['username'])) {
        echo '<a class="btn text-light my-2 my-sm-0 mt-3 mr-3 green-bg" href="register.php" role="button">Register</a>
    <a class="btn text-light my-2 my-sm-0 mt-3 accent-bg" href="login.php" role="button">Login</a>';
      } else {
        echo ' <p class="mr-2 my-2 my-sm-0 mt-3 accent-color">' . $_SESSION['username'] . ' <i class="fa-regular fa-user"></i> </p>';

        echo '<a class="btn text-light my-2 my-sm-0 mt-3 accent-bg" href="logout.php" role="button">Log out</a>';
      }
      ?>

    </div>
    <!-- </div> -->
  </nav>
</header>

<body>
  <div id="wrapper">
    <div id="sidebar-wrapper">
      <ul class="sidebar-nav">
        <div class="row d-flex justify-content-center">
          <div class="col-8 py-5">
            <h6 class="mb-3 font-weight-bold">Categories: </h6>
            <?php
            foreach ($categories as $category) {
              echo "<label class='checkbox-inline mr-4 mb-3'>
      <input type='checkbox' class='category-checkbox' value={$category['id']}>{$category['name']}
    </label>";
            }
            ?>
          </div>
        </div>
      </ul>
    </div>
    <div id="page-content-wrapper" class="vh-100">
      <div class="container-fluid py-4">

        <div class="row  d-flex justify-content-center">
          <div class="col-md-11 col">
            <div class="row">

              <div class="col justify-content-center">
                <button class="btn accent-bg text-light mb-4" id="categories-toggle">Filter by Categories <i
                    class="fa-solid fa-bars"></i></button>
                <div class="row cards d-flex" id="books">


                </div>



              </div>
            </div>
          </div>


        </div>


      </div>


      <!-- Footer  -->
   <footer>
      <div class="container-fluid dark-bg py-4">
        <div class="row d-flex justify-content-center">
          <div class="col-10 text-center" id="content">>

          </div>
        </div>
      </div>
      </footer>
    </div>
  </div>


  <!-- jQuery library -->

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>

  <!-- Latest Compiled Bootstrap 4.6 JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
    integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+"
    crossorigin="anonymous"></script>

  <script src="index.js"></script>
</body>

</html>