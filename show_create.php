<!DOCTYPE html>
<html>

<head>
    <title>Create Show</title>
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
                alt="Logo" /><span class="ml-2 font-weight-bold">MNT ADMIN PANEL</span></a>
        <div class="form-inline accent-color">

            <p class="mr-2 my-2 my-sm-0 mt-3 accent-color">admin<i class="fa-regular fa-user"></i> </p>


            <a class="btn text-light my-2 my-sm-0 mt-3 accent-bg" href="logout.php" role="button">Log out</a>
        </div>
    </nav>
</header>


<body class="text-white bg-color">
    <div id="wrapper">

        <div id="sidebar-wrapper" class="text-white secondary-bg">
            <ul class="sidebar-nav">
                <li class="active-bg"><a href="shows.php" class="active">Books<i
                            class="fa-solid fa-book-open ml-1"></i></a></li>
                <li><a href="authors.php">Authors<i class="fa-solid fa-users ml-1"></i></a></li>
                <li><a href="categories.php">Categories<i class="fa-solid fa-list ml-1"></i></a></li>
                <li><a href="comments.php">Comments<i class="fa-regular fa-comments ml-1"></i></a></li>
            </ul>
        </div>



        <div id="page-content-wrapper" class="">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- <a href="#" class="btn" id="menu-toggle" ><i class="fa-solid fa-bars"></i></a> -->

                        <div class="row py-2 justify-content-center mt-5">

                            <div class="col-10 card p-4 shadow-sm">
                                <h2 class="text-dark mb-3">Create Show</h2>
                                <form class="needs-validation text-dark " novalidate>
                                    <div class="form-row">
                                        <div class="col-md-3 mb-3">
                                            <label for="validationCustom01">*Name</label>
                                            <input type="text" class="form-control" id="validationCustom01" required
                                                name="name">
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="validationCustom01">*Hall number</label>
                                            <input type="number" class="form-control" id="validationCustom02" required
                                                name="hall_number">
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustom03">*Description</label>

                                            <textarea class="form-control" id="validationCustom03" required rows="3"
                                                name="description"></textarea>
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-row mb-3">
                                        <div class="col-md-3 mb-3">
                                            <label for="validationCustom04">*Genre</label>
                                            <select class="custom-select" id="validationCustom04" required
                                                name="genre_id">
                                                <option selected disabled value="">Choose...</option>
                                                <option value="1">Comedy</option>
                                                <option value="2">Romantic</option>


                                            </select>
                                            <div class="invalid-feedback">
                                                Please select a valid genre.
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="validationCustom05">*Age Group</label>
                                            <input type="text" class="form-control" id="validationCustom05" required
                                                name="age_group">
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustom02">*Cover Image</label>
                                            <input type="text" class="form-control" id="validationCustom06" required
                                                name="image">
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>

                                    </div>
                                    <h5>Production Crew</h5>
                                    <div class="form-row">

                                        <div class="col-md-3 mb-3">
                                            <label for="validationCustom05">Director</label>
                                            <input type="text" class="form-control" id="validationCustom07"
                                                name="director">

                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="validationCustom05">Assistant Director</label>
                                            <input type="text" class="form-control" id="validationCustom08"
                                                name="assistant_director">

                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="validationCustom02">Set Designer</label>
                                            <input type="text" class="form-control" id="validationCustom09"
                                                name="set_designer">

                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="validationCustom02">Costume Designer</label>
                                            <input type="text" class="form-control" id="validationCustom10"
                                                name="costume_designer">

                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="validationCustom02">Stage Manager</label>
                                            <input type="text" class="form-control" id="validationCustom11"
                                                name=stage_manager>

                                        </div>

                                    </div>
                                    <button class="btn accent-bg text-light" type="submit">Create Show</button>
                                </form>
                            </div>
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

        function isValidImageUrl(url) {
            return new Promise((resolve, reject) => {
                const img = new Image();

                img.onload = function () {
                    resolve();
                };

                img.onerror = function () {
                    reject();
                };

                img.src = url;
            });
        }
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
                                url: 'Services/show_add.php',
                                data: formData,
                                processData: false,
                                contentType: false,
                                success: function (response) {
                                    Swal.fire({
                                        title: 'Success!',
                                        text: 'Show created successfully!',
                                        icon: 'success',
                                        confirmButtonText: 'OK'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.href = 'shows.php';
                                        }
                                    });
                                },
                                error: function (xhr, status, error) {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'Failed to create show. Please try again.',
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