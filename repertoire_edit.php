<?php
session_start();
if (!isset($_SESSION['firstname']) || !isset($_SESSION['lastname']) || $_SESSION['role'] !== "admin") {
    return header('Location: login.php?errorMessage=Unauthorized');
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Edit Repertoire</title>
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
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abel&display=swap" rel="stylesheet">
    <!-- Latest Font-Awesome CDN -->
    <script src="https://kit.fontawesome.com/83a2a6ffac.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="text-white bg-color">
    <div id="wrapper">

        <!-- Header -->
        <<header class="fixed-top">
            <nav class="navbar text-dark bg-light shadow-sm ">
                <div class="align-items-center d-flex"> <a class="navbar-brand text-uppercase text-dark" href=""><img
                            src="images/logo2.png" alt="Logo" width="70" height="70"
                            class="d-inline-block align-top"></a>
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

            <!-- Main Content -->
            <div id="page-content-wrapper" class="">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row py-2 justify-content-center mt-5">
                                <div class="col-10 card p-4 shadow-sm">
                                    <h2 class="text-dark mb-3">Edit Repertoire</h2>
                                    <form class="needs-validation text-dark" novalidate>
                                        <div class="form-row">
                                            <div class="col-md-6 mb-3">
                                                <label for="validationCustom01">*Date and Time</label>
                                                <input type="datetime-local" class="form-control" id="date_time"
                                                    required name="date_time">
                                                <div class="invalid-feedback">
                                                    This field is required.
                                                </div>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" id="id" name="id"
                                            value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>" hidden>
                                        <input type="text" class="form-control" id="show_id" name="show_id" hidden>
                                        <button class="btn accent-bg text-light" type="submit">Edit Repertoire</button>
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

        $(document).ready(function () {
            var repertoireId = <?php echo isset($_GET['id']) ? $_GET['id'] : 'null'; ?>;
            getRepertoire(repertoireId);
        });

        function getRepertoire(id) {
            $.ajax({
                url: "Services/repertoire_get.php",
                method: "GET",
                data: { id: id },
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        console.log(response)
                        $("#date_time").val(response.data.date_time);
                        $("#name").val(response.data.show.name);
                        $("#show_id").val(response.data.show.id);
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
                                url: 'Services/repertoire_edit.php',
                                data: formData,
                                processData: false,
                                contentType: false,
                                success: function (response) {
                                    Swal.fire({
                                        title: 'Success!',
                                        text: 'Repertoire edited successfully!',
                                        icon: 'success',
                                        confirmButtonText: 'OK',
                                        confirmButtonColor: "#101010"
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.href = `repertoire_details.php?id=<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>`;
                                        }
                                    });
                                },
                                error: function (xhr, status, error) {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'Failed to update repertoire. Please try again.',
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