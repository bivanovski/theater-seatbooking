<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show details</title>
    <link rel="apple-touch-icon" sizes="180x180" href="favicon_package_v0.16/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon_package_v0.16/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon_package_v0.16/favicon-16x16.png">
    <link rel="manifest" href="favicon_package_v0.16/site.webmanifest">
    <link rel="mask-icon" href="favicon_package_v0.16/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/example.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abel&display=swap" rel="stylesheet">
    <!-- Latest Font-Awesome CDN -->
    <script src="https://kit.fontawesome.com/83a2a6ffac.js" crossorigin="anonymous"></script>
    </style>
</head>

<body>

<header>
        <nav class="navbar navbar-expand navbar-dark custom-navbar fixed-top shadow-sm">
            <a class="navbar-brand" href="#">
                <img src="images/logo2.png" alt="Logo" width="70" height="70" class="d-inline-block align-top">
                 <span class="MNT-text">MNT</span>
            </a>


            <div class="collapse navbar-collapse" id="navbarNav">
                <?php if (isset($_SESSION['firstname'])): ?>
                        <a class="mr-2 my-2 my-sm-0 mt-3 text-light text-decoration-none" href="reservations.php"><i
                                class="fa-regular fa-calendar-check mr-2"></i>My Reservations</a>
                <?php endif; ?>

                <div class="ml-auto">
                    <?php if (!isset($_SESSION['firstname'])): ?>
                            <a class="btn nav-btn mr-2" href="register.php">Register</a>
                            <a class="btn nav-btn" href="login.php">Log in</a>
                    <?php else: ?>
                            <div class="d-flex justify-content-center align-items-center">
                                <p class="mr-2 my-2 my-sm-0 mt-3 text-light">
                                    <?php echo $_SESSION['firstname']; ?><i class="fa-regular fa-user ml-1"></i>
                                </p>
                                <a class="btn nav-btn" href="logout.php" role="button">Log out</a>
                            </div>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </header>
    <section class="theater-background">
        <div class="container-fluid" id="show-details-container">
           

        </div>
    </section>
    <footer class="footer black-bg p-4 shadow-sm mt-5">
        <div class="container">
            <p class="text-center text-light" style="margin: 0px!important;">&copy; 2024 Code Crew. All rights reserved.
            </p>
        </div>
    </footer>

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

            $.ajax({
                url: "Services/show_details.php",
                method: "GET",
                data: { show_id: showId },
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        var showData = response.data;
                        $("#show-details-container").html(`
                    
                        <div class="row d-flex justify-content-center">
                <div class="col-10 shadow-sm mt-5">
                    <div class="row p-5">
                        <div class="col-lg-6 d-flex justify-content-center">
                            <img src="${showData.image}"
                                alt="Theater Background" class="img-fluid shadow-sm h-75">

                        </div>
                        <div class="col-lg-6">
                            <div class="d-flex justify-content-between mt-3">
                                <h1 class="accent-color">${showData.name}</h1>
                                <span class="age-label ">${showData.age_group}</span>
                            </div>

                            <p style="font-size: 20px;" class="text-muted">${showData.genre}</p>
                            <h3 class="">About the show</h3>
                            <p class="text-justify">${showData.description}</p>
                            <h4 class="accent-color">Reserve Now</h4>
                            <div id="repertoire-container"></div>
    </div>
                            

                        </div>
                 
                    <h4 class="p-3 px-5 font-weight-bold">Production Crew</h4>
                    <div class="row px-5">

                        <div class="col-md-6">

                            <div class="crew-member">
                                <h5 class="text-dark mb-0">Director:</h5>
                                <p class="accent-color">${showData.director}</p>
                            </div>
                            <div class="crew-member">
                                <h5 class="text-dark mb-0">Assistant Director:</h5>
                                <p class="accent-color">${showData.assistant_director}</p>
                            </div>
                            <div class="crew-member">
                                <h5 class="text-dark mb-0">Costume Designer:</h5>
                                <p class="accent-color">${showData.costum_designer}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="crew-member">
                                <h5 class="text-dark mb-0">Set Designer:</h5>
                                <p class="accent-color">${showData.set_designer}</p>
                            </div>
                            <div class="crew-member">
                                <h5 class="text-dark mb-0">Stage Manager:</h5>
                                <p class="accent-color">${showData.stage_manager}</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>`);
                    } else {
                        $("#show-details-container").html(
                            `<p class="text-danger">${response.message}</p>`
                        );
                    }
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                    $("#show-details-container").html(
                        `<p class="text-danger">Failed to load show details. Please try again later.</p>`
                    );
                },
            });


            loadRepertoires(showId)
            function loadRepertoires(showId) {
                $.ajax({
                    url: "Services/repertoire_get_by_show.php" ,
                    method: "GET",
                    data: { show_id: showId },
                    dataType: "json",
                    success: function (response) {
                        if (response.success) {
                            if(response.data.length >0){
                            var repertoires = response.data;
                            var repertoireHtml = "";
                            repertoires.forEach(function (repertoire) {
                                var dateTime = new Date(repertoire.date_time);
                                var formattedDateTime = dateTime.toLocaleString("en-GB", {
                                    year: "numeric",
                                    month: "2-digit",
                                    day: "2-digit",
                                    hour: "2-digit",
                                    minute: "2-digit",
                                });
                                repertoireHtml += `<a href="reserve.php?id=${repertoire.id}" class="btn mb-2 custom-repertoire-btn mr-2">${formattedDateTime}</a>`;
                            });
                            $("#repertoire-container").html(repertoireHtml);
                        }
                        else{
                            $("#repertoire-container").html(`<p class="text-muted">No repertoires for this show. Check later.</p>`);
                        }
                        } else {
                            $("#repertoire-container").html(
                                `<p class="text-danger">${response.message}</p>`
                            );
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                        $("#repertoire-container").html(
                            `<p class="text-danger">Failed to load repertoires. Please try again later.</p>`
                        );
                    },
                });
            }

        });
        
    </script>


</body>

</html>