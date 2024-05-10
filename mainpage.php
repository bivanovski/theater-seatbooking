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
        /* Custom CSS */
        .custom-navbar {
            background-color: #333; /* Change the color to your desired color */
        }

        .custom-navbar .navbar-brand,
        .custom-navbar .navbar-nav .nav-link {
            color: #fff; /* Change the text color to contrast with the background */
        }
    </style>
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-dark custom-navbar fixed-top shadow-sm">
            <a class="navbar-brand" href="#">
                <img src="images/logo2.png" alt="Logo" width="70" height="70" class="d-inline-block align-top">
                <!-- <span class="ml-2 font-weight-bold">MNT ADMIN PANEL</span> -->
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Main Page</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Premiers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">Buy ticket</a>
                    </li>
                </ul>
                <style>
                    /* Style for the nav bars */
                    .navbar-nav .nav-link {
                        font-size: 18px; 
                        
                    }
                </style>
                <div class="my-2 my-lg-0">
                    <button class="btn btn-danger mr-2" >Register</button>
                    <button class="btn btn-danger">Log in</button>
                    <!-- <p class="right">Register</p>
                    <a class="right" href="logout.php" role="button">Log in</a> -->
                </div>
                <style>

                </style>
            </div>
        </nav>
    </header>

    <section class="theater-background vh-50
    " >
        <img src="https://images.ctfassets.net/6pezt69ih962/1O40LqsEvLqXzhEluBRbzH/df5c7bc9f6f151c28d9fc484bb13451b/DL_house.jpeg"
            alt="Theater Background" class="img-fluid w-100" style="height:75vh;">
    </section>
   
    <div class="container">
        <div class="text-right my-3">
            <button class="btn btn-danger" style="font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif">Filter</button>
        </div>
        <div class="text-left my-3">
            <h2 style="font-family:Arial, Helvetica, sans-serif; font-style: italic;">Most popular</h2>

        </div>

        <div class="row py-5 justify-content-center mt-5">

            <div class="col-10" style="padding: 0px!important;">
            
                <div class="row justify-content-start" id="showCards">
                </div>
            </div>
        </div>


        
            <!-- <div class="col-md-4">
                <a href="">
                <div class="card mb-3">
                    <img src="https://mnt.mk/media/k2/items/cache/fe77b047cf65bbf66915926fa3c00c93_L.jpg"
                        class="card-img-top" alt="...">
                    <div class="card-body">
                        <button class="btn btn-danger">24 April, 19:30</button>
                        <button class="btn btn-outline-dark">12+</button>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-md-4">
                <div class="card mb-3">
                    <img src="https://mnt.mk/media/k2/items/cache/2940b97ab5721a9e279f736f864f4ce6_L.jpg"
                        class="card-img-top" alt="...">
                    <div class="card-body">
                        <button class="btn btn-danger">20 May, 18:00</button>
                        <button class="btn btn-outline-dark">18+</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-3">
                    <img src="https://mnt.mk/media/k2/items/cache/e1479c60fc7d7f4f708d42f869f837c8_L.jpg"
                        class="card-img-top" alt="...">
                    <div class="card-body">
                        <button class="btn btn-danger">26 April, 19:00</button>
                        <button class="btn btn-outline-secondary">12+</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-3">
                    <img src="https://mnt.mk/media/k2/items/cache/5467774f5535dc0e0bd116e89a59b7ab_L.jpg"
                        class="card-img-top" alt="...">
                    <div class="card-body">
                        <button class="btn btn-danger">2 May 19:30</button>
                        <button class="btn btn-outline-secondary">12+</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-3">
                    <img src="https://mnt.mk/media/k2/items/cache/013018afcf84fd53ed1be7bac0415c88_L.jpg"
                        class="card-img-top" alt="...">
                    <div class="card-body">
                        <button class="btn btn-danger">10 May, 18:00</button>
                        <button class="btn btn-outline-secondary">18+</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-3">
                    <img src="https://mnt.mk/media/k2/items/cache/da388805d72915b428bc7670a13b37e3_L.jpg"
                        class="card-img-top" alt="...">
                    <div class="card-body">
                        <button class="btn btn-danger">16 April, 19:00</button>
                        <button class="btn btn-outline-secondary">19+</button>
                    </div>
                </div>
            </div>

        </div> -->


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
                getShows();
                function getShows() {
                    $.ajax({
                      url: "Services/show_get.php",
                      type: "GET",
                      dataType: "json",
                      success: function (response) {
                        if (response.success) {
                          $("#showCards").empty();
                  console.log(response)
                          $.each(response.data, function (index, show) {
                            var cardHtml = `
                            <div class="col-md-3 mb-5">
                                <a href="show_details.php?id=1" class="card-link">
                                    <div class="card text-dark shadow-sm show" data-show-id="1">
                                        <img src=${show.image} class="card-img-top" alt=${show.name}>
                                        <div class="card-body">
                                            <h5 class="card-title accent-color">${show.name}</h5>
                                            <div class="d-flex justify-content-between">
                                                <p class="card-text">Genre: Age: </p>
                                                <p class="card-text primary-color">${show.genre} ${show.age_group}</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            
                              `;
                            $("#showCards").append(cardHtml);
                          });
                        } else {
                          console.error("Failed to fetch shows");
                        }
                      },
                      error: function (xhr, status, error) {
                        console.error("Error fetching shows:", error);
                      },
                    });
                  }
            });
    
        </script>
    
    </body>
    
    </html> 
