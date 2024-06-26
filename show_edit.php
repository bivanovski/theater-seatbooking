<?php
session_start();
if (!isset($_SESSION['firstname']) || !isset($_SESSION['lastname']) || $_SESSION['role'] !== "admin") {
    return header('Location: login.php?errorMessage=Unauthorized');
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Edit Show</title>
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abel&display=swap" rel="stylesheet">
    <!-- Latest Font-Awesome CDN -->
    <script src="https://kit.fontawesome.com/83a2a6ffac.js" crossorigin="anonymous"></script>


</head>

<header class="fixed-top">
    <nav class="navbar text-dark bg-light shadow-sm ">
        <div class="align-items-center d-flex"> <a class="navbar-brand text-uppercase text-dark" href=""><img
                    src="images/logo2.png" alt="Logo" width="70" height="70" class="d-inline-block align-top"></a>
            <span class="ml-2 font-weight-bold">MNT ADMIN PANEL</span>
        </div>

        <div class="form-inline accent-color">

            <p class="mr-2 my-2 my-sm-0 mt-3 accent-color">
                <?php echo $_SESSION['firstname'] ?><i class="fa-regular fa-user"></i>
            </p>


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
                                <h2 class="text-dark mb-3">Edit Show</h2>
                                <form class="needs-validation text-dark " novalidate>
                                    <div class="form-row">
                                        <div class="col-md-3 mb-3">
                                            <label for="validationCustom01">*Name</label>
                                            <input type="text" class="form-control" id="name" required name="name">
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="validationCustom01">*Hall number</label>
                                            <input type="number" class="form-control" id="hall_number" required
                                                name="hall_number">
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustom03">*Description</label>

                                            <textarea class="form-control" id="description" required rows="3"
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
                                                name="genre_id" id="genre">
                                                <!-- <option selected disabled value="">Choose...</option> -->
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select a valid genre.
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="validationCustom05">*Age Group</label>
                                            <select class="custom-select" id="validationCustom05" required
                                                name="age_group" id="age_group">
                                                <option selected disabled value="">Choose...</option>
                                                <option value="18+">18+</option>
                                                <option value="16+">16+</option>
                                                <option value="12+">12+</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustom02">*Cover Image</label>
                                            <input type="text" class="form-control" id="image" required name="image">
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>

                                    </div>
                                    <h5>Production Crew</h5>
                                    <div class="form-row">

                                        <div class="col-md-3 mb-3">
                                            <label for="validationCustom05">Director</label>
                                            <input type="text" class="form-control" id="director" name="director">

                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="validationCustom05">Assistant Director</label>
                                            <input type="text" class="form-control" id="assistant_director"
                                                name="assistant_director">

                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="validationCustom02">Set Designer</label>
                                            <input type="text" class="form-control" id="set_designer"
                                                name="set_designer">

                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="validationCustom02">Costume Designer</label>
                                            <input type="text" class="form-control" id="costume_designer"
                                                name="costume_designer">

                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="validationCustom02">Stage Manager</label>
                                            <input type="text" class="form-control" id="stage_manager"
                                                name=stage_manager>

                                        </div>
                                        <input type="text" class="form-control" id="show_id" name="show_id"
                                            value="<?php echo $_GET['id']; ?>" hidden>


                                    </div>
                                    <button class="btn accent-bg text-light" type="submit">Edit Show</button>
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
    <script>
        $(document).ready(function () {
            var showId = <?php echo $_GET['id']; ?>;
            var selectedGenre;
            function getShow(showId) {
                $.ajax({
                    url: "Services/show_details.php",
                    method: "GET",
                    data: { show_id: showId },
                    dataType: "json",
                    success: function (response) {
                        if (response.success) {
                            $("#show_id").val(response.data.id);
                            $("#name").val(response.data.name);
                            $("#hall_number").val(response.data.hall_number);
                            $("#description").val(response.data.description);
                            $("#genre_id").val(response.data.genre_id);
                            $("#age_group").val(response.data.age_group);
                            $("#director").val(response.data.director);
                            $("#assistant_director").val(response.data.assistant_director);
                            $("#costume_designer").val(response.data.costum_designer);
                            $("#stage_manager").val(response.data.stage_manager);
                            $("#set_designer").val(response.data.set_designer);
                            $("#image").val(response.data.image);

                            populateGenres(response.data.genre_id);
                            $("#validationCustom05").val(response.data.age_group);
                        } else {
                            // Handle error
                            console.error("Failed to load show details:", response.message);
                        }
                    },
                    error: function (xhr, status, error) {
                        // Handle error
                        console.error("Error loading show details:", error);
                    },
                });
            }
            getShow(showId);
        });
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

        function populateGenres(selectedGenreId) {
            $.ajax({
                url: "Services/genre_get.php",
                type: "GET",
                dataType: "json",
                success: function (response) {
                    if (response.data.length > 0) {
                        var genreSelect = $("#validationCustom04");
                        genreSelect.empty();

                        $.each(response.data, function (index, genre) {
                            var selected = genre.id == selectedGenreId ? 'selected' : '';
                            genreSelect.append(`<option value="${genre.id}" ${selected}>${genre.genre}</option>`);
                        });
                    } else {
                        console.error("No genres found");
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Error fetching genres:", error);
                }
            });
        }


        // $(document).ready(function () {
        //     populateGenres();
        // });
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
                                url: 'Services/show_edit.php',
                                data: formData,
                                processData: false,
                                contentType: false,
                                success: function (response) {
                                    Swal.fire({
                                        title: 'Success!',
                                        text: 'Show edited successfully!',
                                        icon: 'success',
                                        confirmButtonText: 'OK',
                                        confirmButtonColor: "#101010"
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.href = `show_details.php?id=${<?php echo $_GET['id']; ?>}`;
                                        }
                                    });
                                },
                                error: function (xhr, status, error) {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'Failed to update show. Please try again.',
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

</html>