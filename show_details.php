<!DOCTYPE html>
<html>

<head>
    <title>Show Details</title>
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

                        <div class="row py-2 justify-content-center mt-5">

                            <div class="col-10 card p-4 shadow-sm" id="show-details-container">
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
            var showId = <?php echo $_GET['id']; ?>;
            loadShowDetails(showId);
            loadRepertoires(showId);
            $(document).on("click", ".custom-outline-btn", function () {
               
                var repertoireId = $(this).data("repertoire-id");

                window.location.href = "repertoire_details.php?id=" + repertoireId;
            });
            $(document).on('click', '.delete-show-btn', function () {
                console.log("cl")
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'All repertoires of this show will also be deleted!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                            url: 'Services/show_delete.php',
                            method: 'POST',
                            data: { show_id: showId },
                            dataType: 'json',
                            success: function (response) {
                                if (response.success) {

                                    Swal.fire(
                                        'Deleted!',
                                        response.message,
                                        'success'
                                    ).then(() => {

                                        window.location.href = 'shows.php';
                                    });
                                } else {

                                    Swal.fire(
                                        'Error!',
                                        response.message,
                                        'error'
                                    );
                                }
                            },
                            error: function (xhr, status, error) {
                                console.error(xhr.responseText);

                                Swal.fire(
                                    'Error!',
                                    'Failed to delete show. Please try again later.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });
    </script>
</body>

</html>