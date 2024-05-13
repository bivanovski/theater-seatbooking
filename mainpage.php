<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/example.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Abel&display=swap" rel="stylesheet">

    <style>
    .navbar-brand {
        display: flex;
        align-items: center; /
    }

    .navbar-brand img {
        margin-right: 15px; 
    }

    .MNT-text {
        font-family: 'Georgia', sans-serif;
        font-size: 34px; 
        color: white;
        font-weight: bold;
       
    }
</style>

    
</head>

<body>

    <header>
        <nav class="navbar navbar-expand navbar-dark custom-navbar fixed-top shadow-sm">
            <a class="navbar-brand" href="#">
                <img src="images/logo2.png" alt="Logo" width="70" height="70" class="d-inline-block align-top">
                 <span class="MNT-text">MAKEDONSKI NARODEN TEATAR</span>
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

    <section class="theater-background vh-50
    ">
        <img src="https://images.ctfassets.net/6pezt69ih962/1O40LqsEvLqXzhEluBRbzH/df5c7bc9f6f151c28d9fc484bb13451b/DL_house.jpeg"
            alt="Theater Background" class="img-fluid w-100" style="height:75vh;">
    </section>

    <div class="container-fluid linear-bg">

    

        <div class="row justify-content-center mt-5">

            <div class="col-8" style="padding: 0px!important;">
                <div class="row d-flex justify-content-between mb-3">
                    <h2>Most popular</h2>


    <style>
    
    .dropdown button {
        background-color: #b80725;
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        font-size: 1rem;
    }

    
    .dropdown button i {
        margin-right: 0.5rem;
    }

    
    .dropdown-menu {
        background-color: white;
        color: black;
        border: 1px solid #ccc;
        border-radius: 0.25rem;
        padding: 0.5rem;
    }
    </style>

                    <div class="dropdown">
                        <button class="btn btn-sm black-bg text-light dropdown-toggle" data-toggle="dropdown"> <i
                                class="fa-solid fa-arrow-up-wide-short mr-2"></i>Filter
                        </button>
                        
                        
                        <div class="dropdown-menu">
                            <h6 class="dropdown-header">Genres</h6>
                            <ul class="list-unstyled" id="genreList">
                            </ul>
                            <div class="dropdown-divider"></div>
                            <h6 class="dropdown-header">Age Groups</h6>
                            <ul class="list-unstyled">
                                <li class="ml-2"><input type="checkbox" id="age18" class="mr-2 custom-checkbox"
                                        value="18+"><label for="age18">18+</label></li>
                                <li class="ml-2"><input type="checkbox" id="age16" class="mr-2 custom-checkbox"
                                        value="16+"><label for="age16">16+</label></li>
                                <li class="ml-2"><input type="checkbox" id="age12" class="mr-2 custom-checkbox"
                                        value="12+"><label for="age12">12+</label></li>
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="row justify-content-start" id="showCards">
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

                function getShows() {

                    var selectedGenres = $("input[type=checkbox][id^=genre]:checked").map(function () {
                        return parseInt($(this).val());
                    }).get();

                    var selectedAgeGroups = $("input[type=checkbox][id^=age]:checked").map(function () {
                        return $(this).val();
                    }).get();

                    console.log(selectedAgeGroups)
                    console.log(selectedGenres)
                    var requestData = {};
                    if (selectedGenres.length > 0) {
                        requestData.genres = selectedGenres.join(',');
                    }
                    if (selectedAgeGroups.length > 0) {
                        requestData.age_groups = selectedAgeGroups.join(',');
                    }
                    $.ajax({
                        url: "Services/show_get.php",
                        type: "GET",
                        dataType: "json",
                        data: requestData,
                        success: function (response) {
                            if (response.success) {
                                $("#showCards").empty();

                                if (response.data.length === 0) {
                                    $("#showCards").append('<p class="text-center text-light">No shows according to this filter.</p>');
                                } else {
                                    $.each(response.data, function (index, show) {
                                        var cardHtml = `
                                <div class="col-md-4 mb-5">
                                    <a href="show_details.php?id=${show.id}" class="card-link">
                                        <div class="card text-dark shadow-sm shows" data-show-id="${show.id}">
                                            <img src="${show.image}" class="card-img-top" alt="${show.name}">
                                            <div class="card-body">
                                                <h5 class="card-title accent-color">${show.name}</h5>
                                                <div class="d-flex justify-content-between">
                                                    <p class="card-text">Genre: ${show.genre}</p>
                                                    <p class="card-text primary-color">${show.age_group}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>`;
                                        $("#showCards").append(cardHtml);
                                    });
                                }
                            } else {
                                console.error("Failed to fetch shows");
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error("Error fetching shows:", error);
                        }
                    });
                }

                function populateGenres() {
                    $.ajax({
                        url: "Services/genre_get.php",
                        type: "GET",
                        dataType: "json",
                        success: function (response) {
                            if (response.data.length > 0) {
                                var genreList = $("#genreList");
                                genreList.empty();
                                response.data.forEach(function (genre) {
                                    genreList.append(`<li class="ml-2">
                                <input type="checkbox" id="genre_${genre.genre}" class="mr-2 custom-checkbox" value=${genre.id}>
                                <label for="genre_${genre.genre}" class="custom-label">${genre.genre}</label>
                            </li>`);
                                });
                            } else {
                                console.error("No genres found");
                            }
                            getShows();
                        },
                        error: function (xhr, status, error) {
                            console.error("Error fetching genres:", error);
                        }
                    });
                }
                populateGenres();



                $(document).on("change", ".custom-checkbox", getShows);
            });
        </script>

</body>

</html>