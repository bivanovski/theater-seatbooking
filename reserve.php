<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserve</title>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="css/seatchart.css" />
    <link rel="stylesheet" href="css/example.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Abel&display=swap" rel="stylesheet">


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

    <div class="container-fluid">

        <div class="row d-flex justify-content-center p-5">
            <div class="col-lg-10 shadow-sm p-3 mb-2">
                <div class="row d-flex justify-content-center p-3">
                    <h2 id="show_title">
                        Title Of The Show - <span class="accent-color" id="show_details_placeholder">Date Time</span>
                    </h2>
                </div>
                <div class="row reserve-text d-flex justify-content-center">
                    <div class="col-10">
                        <h3 class="text-dark text-center">
                            Reserve a Ticket
                        </h3>
                        <p class="text-dark text-center">Attention! The tickets you reserved must be paid for at least
                            30 minutes before the start
                            of the show or else your reservation will not be valid.</p>
                        <p class="text-dark text-center">You can only reserve up to 4 tickets for a single repertoire.
                        </p>
                    </div>

                </div>
            </div>
            <div class="row d-flex justify-content-center" id="seat-cart-div">
                <div id="container" class="text-dark col-9 d-flex justify-content-center"></div>
            </div>
        </div>

    </div>
    </div>
    </div>
    <footer class="footer black-bg p-4 shadow-sm mt-5">
        <div class="container">
            <p class="text-center text-light" style="margin: 0px!important;">&copy; 2024 Code Crew. All rights reserved.
            </p>
        </div>
    </footer>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/seatchart@0.1.0/dist/seatchart.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function () {
            var user_id = <?php echo isset($_SESSION['id']) ? $_SESSION['id'] : 'null'; ?>;
            console.log(user_id)
            var repertoire_id = <?php echo $_GET['id'] ?>;
            var reservedSeats = [];
            var userReservationsCount;
            fetchUserReservations();
            getRepertoire(repertoire_id)
            function fetchUserReservations() {
                $.ajax({
                    url: 'Services/reservation_get_by_rep_groupedBy_user.php?repertoire_id=' + repertoire_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function (response) {
                        if (response.success) {
                            userReservationsCount = 0;
                            $.each(response.data, function (index, reservation) {
                                if (reservation.user_id == user_id)
                                    userReservationsCount += reservation.reservations.length;
                            });

                            fetchReservedSeats();
                            console.log(userReservationsCount)
                            initializeSeatchart(reservedSeats, userReservationsCount);
                        } else {
                            console.error('Error fetching reservations:', response.message);
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('AJAX error:', error);
                    }
                });
            }
            function getRepertoire(id) {
                $.ajax({
                    url: "Services/repertoire_get.php",
                    method: "GET",
                    data: { id: id },
                    dataType: "json",
                    success: function (response) {
                        if (response.success) {

                            var dateTime = new Date(response.data.date_time);

                            var formattedDateTime = dateTime.toLocaleString("en-GB", {
                                year: "numeric",
                                month: "2-digit",
                                day: "2-digit",
                                hour: "2-digit",
                                minute: "2-digit",
                            });

                            var showName = response.data.show.name;
                            $("#show_image").attr("src", response.data.show.image);
                            $("#show_title").html(`
                    ${showName} - <span class="accent-color" id="show_details_placeholder">${formattedDateTime}</span>
                `);


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
            function fetchReservedSeats() {
                $.ajax({
                    url: 'Services/reservation_get_by_repertoire.php?repertoire_id=' + repertoire_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function (response) {
                        if (response.success && response.data.length > 0) {
                            reservedSeats = [];

                            $.each(response.data, function (index, reservation) {
                                reservedSeats.push({
                                    row: parseInt(reservation.row) - 1,
                                    col: parseInt(reservation.seat_num) - 1
                                });
                            });

                            initializeSeatchart(reservedSeats, userReservationsCount);
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('AJAX error:', error);
                    }
                });
            }

            function initializeSeatchart(reservedSeats, userReservationsCount) {
                var options = {
                    map: {
                        rows: 17,
                        columns: 16,
                        seatTypes: {
                            default: {
                                label: "General",
                                cssClass: "general",
                                price: 10,
                            },
                            vip1: {
                                label: "VIP 1",
                                cssClass: "vip1",
                                price: 25,
                                seatRows: [14, 15, 16],
                            },
                            vip2: {
                                label: "VIP 2",
                                cssClass: "vip2",
                                price: 15,
                                seatRows: [12, 13],
                            },
                        },
                        reservedSeats: reservedSeats,
                        rowSpacers: [3, 7, 12],
                        columnSpacers: [8]
                    },
                    cart: { currency: "", submitLabel: "Reserve" }
                };

                var element = document.getElementById("container");
                var sc = new Seatchart(element, options);
                var frontDiv = document.querySelector(".sc-front");
                frontDiv.textContent = "Stage";
                var title = document.querySelector(".sc-cart-title");
                title.style.display = "none";
                sc.addEventListener("submit", function handleSubmit(e) {
                    console.log(e);
                    if (user_id === null) {

                        Swal.fire({
                            title: "Error!",
                            text: "You need to be logged in to make a reservation.",
                            icon: "error",
                            confirmButtonColor: "#101010"
                        }).then(function () {
                            window.location.href = "login.php";
                        });
                    } else {
                        if (e.cart.length > 4) {
                            Swal.fire({
                                title: "Error!",
                                text: "You can only select maximum 4 seats!",
                                icon: "error",
                                confirmButtonColor: "#101010"
                            });
                        } else {
                            console.log("res", userReservationsCount)
                            if (e.cart.length <= 4 - userReservationsCount) {
                                var seatsSelected = e.cart.length;
                                var reservationsMade = 0;

                                e.cart.forEach(function (reservation) {
                                    console.log(reservation);
                                    var seat_type_id;
                                    if (reservation.type == 'default')
                                        seat_type_id = 1;
                                    else if (reservation.type == 'vip1')
                                        seat_type_id = 2;
                                    else
                                        seat_type_id = 3;

                                    $.ajax({
                                        url: 'Services/reservation_add.php',
                                        type: 'POST',
                                        data: {
                                            user_id: user_id,
                                            row: reservation.index.row + 1,
                                            seat_num: reservation.index.col + 1,
                                            repertoire_id: repertoire_id,
                                            seat_type_id: seat_type_id
                                        },
                                        success: function (response) {
                                            if (response.success) {
                                                console.log('Reservation added:', response);
                                                reservationsMade++;
                                                if (reservationsMade === seatsSelected) {

                                                    Swal.fire({
                                                        title: "Success!",
                                                        text: "Your seats have been reserved.",
                                                        icon: "success",
                                                        confirmButtonColor: "#101010"
                                                    }).then(function () {
                                                        window.location.href = "reservations.php";
                                                    });
                                                }
                                            } else {
                                                console.log('Error adding reservation:', response);
                                                Swal.fire({
                                                    title: "Error!",
                                                    text: response.message,
                                                    icon: "error",
                                                    confirmButtonColor: "#101010"
                                                });
                                            }

                                            fetchReservedSeats();
                                        },
                                        error: function (xhr, status, error) {
                                            console.error('AJAX error:', error);
                                        }
                                    });
                                });
                            } else {
                                Swal.fire({
                                    title: "Error!",
                                    text: "You exceed the maximum number of reservations!",
                                    icon: "error",
                                    confirmButtonColor: "#101010"
                                });
                            }
                        }
                    }
                });
                sc.addEventListener("cartchange", function handleCartChangeEvent(e) {
                    if (sc.getCart().length > 4) {
                        Swal.fire({
                            title: "Error!",
                            text: "You can only select up to 4 seats.",
                            icon: "error",
                            confirmButtonColor: "#101010"
                        });
                        e.seat.state = "available";

                        var cartTable = document.querySelector(".sc-cart-table");

                        var rows = cartTable.getElementsByTagName("tr");
                        if (rows.length > 1) {
                            cartTable.deleteRow(rows.length - 1);
                        }

                        console.log(e.action);
                        var cart = sc.getCart();

                        cart.pop();

                        console.log(sc.getCart());
                    }
                });
            }
        });
    </script>




</body>

</html>