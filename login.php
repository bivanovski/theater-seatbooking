<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    
    <meta charset="utf-8" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <link rel="apple-touch-icon" sizes="180x180" href="favicon_package_v0.16/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon_package_v0.16/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon_package_v0.16/favicon-16x16.png">
    <link rel="manifest" href="favicon_package_v0.16/site.webmanifest">
    <link rel="mask-icon" href="favicon_package_v0.16/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <!-- Latest compiled and minified Bootstrap 4.6 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <!-- CSS script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/example.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abel&display=swap" rel="stylesheet">
    <!-- Latest Font-Awesome CDN -->
    <script src="https://kit.fontawesome.com/83a2a6ffac.js" crossorigin="anonymous"></script>


</head>

<header>
    <nav class="navbar navbar-expand navbar-dark custom-navbar fixed-top shadow-sm">
        <a class="navbar-brand" href="#">
            <img src="images/logo2.png" alt="Logo" width="70" height="70" class="d-inline-block align-top">
            <span class="MNT-text">MNT</span>
        </a>

        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="ml-auto">

                <a class="btn nav-btn mr-2" href="register.php">Register</a>

            </div>
        </div>
    </nav>
</header>



<body class="text-white">
    
            <div class="container-fluid text-dark">
                <div class="row justify-content-center mt-5 mb-5">
                    <div class="col-lg-4 col-12">
                        <img class="img-fluid w-25 mx-auto d-block mb-3" src="images/logo2.png" alt="">
                        <div class="p-4 shadow-sm">
                            <?php

                            $errorMessage = $_GET['errorMessage'] ?? '';

                            if (!empty($errorMessage)) {
                                echo "<div class=\"text-center alert alert-danger rounded\">$errorMessage</div>";
                            }

                            ?>
                            <form action="Services/login_submit.php" class="needs-validation" method="POST" novalidate>

                                <div class="form-group input-control">
                                    <label for="username">Email</label>
                                    <input type="email" class="form-control" required id="email" name="email"
                                        placeholder="Email">
                                    <div class="invalid-feedback">
                                        Enter a valid email address.
                                    </div>
                                </div>
                                <div class="form-group input-control">
                                    <label for="name">Password</label>
                                    <input type="password" class="form-control" required id="password" name="password"
                                        placeholder="Password">
                                    <div class="invalid-feedback">
                                        This field is required.
                                    </div>
                                </div>

                                <button class="btn black-bg text-light btn-block">Login</button>
                                <p class="mt-3">Not a member? <a href="register.php" class="text-dark"
                                        src=""><u>Register
                                            now</u></a></p>
                            </form>
                        </div>
                    </div>
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

    <script src="js/admin.js"></script>
    <script>
        (function () {
            'use strict';
            window.addEventListener('load', function () {

                var forms = document.getElementsByClassName('needs-validation');

                var validation = Array.prototype.filter.call(forms, function (form) {
                    form.addEventListener('submit', function (event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');

                        if (form.checkValidity() === true) {
                            event.preventDefault();
                            var formData = new FormData(form);
                            $.ajax({
                                type: 'POST',
                                url: 'Services/login_submit.php',
                                data: formData,
                                processData: false,
                                contentType: false,
                                success: function (response) {

                                    if (response.success) {
                                        if (response.data.role === 'admin') {
                                            window.location.href = 'shows.php';
                                        } else {
                                            window.location.href = 'index.php';
                                        }
                                    } else {

                                        Swal.fire({
                                            title: 'Please try again!',
                                            text: 'Incorrect email or password.',
                                            icon: 'error',
                                            confirmButtonText: 'OK',
                                            confirmButtonColor: "#101010"
                                        });
                                    }

                                },
                                error: function (xhr, status, error) {

                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'Failed to login. Please try again.',
                                        icon: 'error',
                                        confirmButtonText: 'OK',
                                        confirmButtonColor: "#101010"
                                    });
                                }
                            });
                        }
                    }, false);
                });
            }, false);
        })();

    </script>

</body>
<footer class="footer black-bg p-4 shadow-sm footer-pos">
        <div class="container">
            <p class="text-center text-light" style="margin: 0px!important;">&copy; 2024 Code Crew. All rights reserved.
            </p>
        </div>
    </footer>
</html>