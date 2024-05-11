<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserve</title>
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

    <style>
        /* Custom CSS */
        .custom-navbar {
            background-color: #333;
            /* Change the color to your desired color */
        }

        .custom-navbar .navbar-brand,
        .custom-navbar .navbar-nav .nav-link {
            color: #fff;
            /* Change the text color to contrast with the background */
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
                    <a class="btn nav-btn mr-2" href="register.php">Register</a>
                    <a class="btn nav-btn" href="login.php">Log in</a>
                    <!-- <p class="right">Register</p>
                    <a class="right" href="logout.php" role="button">Log in</a> -->
                </div>
                <style>

                </style>
            </div>
        </nav>
    </header>
    <section class="premiers-background">
        <img src="https://novamakedonija.com.mk/wp-content/uploads/2022/12/mnt.jpg" alt="Theater Background"
            class="img-fluid w-100 shadow-sm" style="height:50vh;">
    </section>
    <div class="container-fluid">

        <div class="row d-flex justify-content-center p-5">
            <div class="col-10 card shadow-sm p-3">
                <div class="row d-flex justify-content-center p-3">
                    <h2>
                        Title Of The Show - <span class="accent-color">14/01/2023 18:00</span>
                    </h2>
                </div>
                <div class="row">
                    <div class="col-12 d-flex justify-content-center">
                        <div class="p-3">

                            <h3 class="text-dark">
                                Reserve a Ticket
                            </h3>
                            <p>Attention! The tickets you reserved must be paid for at least 30 minutes before the start
                                of the show or else your reservation will not be valid.</p>


                        </div>

                        <div id="container" class="text-dark "></div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    </div>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/seatchart@0.1.0/dist/seatchart.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>

$(document).ready(function () {
    var userReservationsCount = 0;
    var user_id = 3
    var reservedSeats = []; // Define reservedSeats as an empty array

    fetchUserReservations()
    function fetchUserReservations() {
        $.ajax({
            url: 'Services/reservation_get_by_rep_groupedBy_user.php?repertoire_id=2',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    $.each(response.data, function (index, reservation) {
                        if (reservation.user_id == user_id)
                            userReservationsCount = reservation.reservations.length
                    });
                    fetchReservedSeats();
                    initializeSeatchart(reservedSeats); // Pass reservedSeats to initializeSeatchart()
                } else {
                    console.error('Error fetching reservations:', response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX error:', error);
            }
        });
    }

    function fetchReservedSeats() {
        $.ajax({
            url: 'Services/reservation_get_by_repertoire.php?repertoire_id=2',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                if (response.success && response.data.length > 0) {
                    reservedSeats = []; // Reset reservedSeats to an empty array

                    $.each(response.data, function (index, reservation) {
                        reservedSeats.push({
                            row: parseInt(reservation.row) - 1,
                            col: parseInt(reservation.seat_num) - 1
                        });
                    });

                    initializeSeatchart(reservedSeats); // Update reservedSeats and call initializeSeatchart() again
                } else {
                    alert('No reservations found.');
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX error:', error);
            }
        });
    }

    function initializeSeatchart(reservedSeats) {
        var options = {
            map: {
                rows: 17,
                columns: 16,
                seatTypes: {
                    default: {
                        label: "General",
                        cssClass: "general",
                        price: 15,
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
                        price: 10,
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
            if (e.cart.length > 4) {
                Swal.fire({
                    title: "Error!",
                    text: "You can only select up to 4 seats.",
                    icon: "error"
                });
            } else {
                if (e.cart.length <= 4 - userReservationsCount) {
                    e.cart.forEach(function (reservation) {
                        console.log(reservation);
                        $.ajax({
                            url: 'Services/reservation_add.php',
                            type: 'POST',
                            data: {
                                user_id: user_id,
                                row: reservation.index.row + 1,
                                seat_num: reservation.index.col + 1,
                                repertoire_id: 2,
                                seat_type_id: 1
                            },
                            success: function (response) {
                                if (response.success) {
                                    console.log('Reservation added:', response);
                                    Swal.fire({
                                        title: "Success!",
                                        text: "Your seats have been reserved.",
                                        icon: "success"
                                    });
                                } else {
                                    console.log('Error adding reservation:', response);
                                    Swal.fire({
                                        title: "Error!",
                                        text: response.message,
                                        icon: "error"
                                    });
                                }

                                fetchReservedSeats();
                            },
                            error: function (xhr, status, error) {
                                console.error('AJAX error:', error);
                            }
                        });
                    });
                }
                else {
                    Swal.fire({
                        title: "Error!",
                        text: "You exceed the maximum number of reservations!",
                        icon: "error"
                    });
                }
            }
        });
        sc.addEventListener("cartchange", function handleCartChangeEvent(e) {
            if (sc.getCart().length > 4) {
                Swal.fire({
                    title: "Error!",
                    text: "You can only select up to 4 seats.",
                    icon: "error"
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