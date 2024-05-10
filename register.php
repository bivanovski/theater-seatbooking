<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
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
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abel&display=swap" rel="stylesheet">
    <!-- Latest Font-Awesome CDN -->
    <script src="https://kit.fontawesome.com/83a2a6ffac.js" crossorigin="anonymous"></script>


</head>

<header class="fixed-top">
    <nav class="navbar text-dark bg-light shadow-sm ">
        <a class="navbar-brand text-uppercase text-dark" href=""><img class="logo-menu img-fluid" src="images/logo2.png"
                alt="Logo" /><span class="ml-2 ">МАКЕДОНСКИ НАРОДЕН ТЕАТАР</span></a>
        <div class="form-inline accent-color">
            <a class="btn text-light my-2 my-sm-0 mt-3 accent-bg" href="login.php" role="button">Login</a>
        </div>
    </nav>
</header>


<body class="text-white bg-color">
    <div id="wrapper">

        <div id="page-content-wrapper" class="">
            <div class="container-fluid text-dark">
                <div class="row justify-content-center mt-5 mb-5">
                    <div class="col-4">
                    <img class="img-fluid w-25 mx-auto d-block mb-3" src="images/logo2.png" alt="">
                        <div class="card p-4 shadow-sm">
                            
                            <form action="" class="needs-validation" method="POST" novalidate>
                                <div class="form-group input-control">
                                    <label for="username">First Name</label>
                                    <input type="text" class="form-control" required id="firstname" name="firstname"
                                        placeholder="First Name">
                                        <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                </div>
                                <div class="form-group input-control">
                                    <label for="username">Last Name</label>
                                    <input type="text" class="form-control" required id="lastname" name="lastname"
                                        placeholder="Last Name">
                                        <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                </div>
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

                                <button class="btn accent-bg text-light btn-block">Register</button>
                               
                            </form>
                        </div>
                    </div>
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
                                url: 'Services/register_submit.php',
                                data: formData,
                                processData: false,
                                contentType: false,
                                success: function (response) {
                                    window.location.href = 'mainpage.html'; 
                                },
                                error: function (xhr, status, error) {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'Failed to register. Please try again.',
                                        icon: 'error',
                                        confirmButtonText: 'OK'
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

</html>