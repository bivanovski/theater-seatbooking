<!DOCTYPE html>
<html lang="en">

<head>
    <title>Demo</title>
    <meta charset="utf-8" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/seatchart@0.1.0/dist/seatchart.css" />     -->
    <link rel="stylesheet" href="css/seatchart.css" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abel&display=swap" rel="stylesheet">

    <style>
        body {
            display: flex;
            justify-content: center;
            font-family: "Abel", sans-serif;
            font-weight: 400;
            font-style: normal;
        }

        .economy {
            color: white;
            background-color: #43aa8b;

        }

        .first-class {
            color: white;
            background-color: #277da1;

        }

        .reduced {
            color: white;
            background-color: #f8961e;

        }
    </style>
</head>

<body>
    <div id="container"></div>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/seatchart@0.1.0/dist/seatchart.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
 $(document).ready(function () {
 
    function fetchReservedSeats() {
        $.ajax({
            url: 'Services/reservation_get_by_repertoire.php?repertoire_id=2',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                if (response.success && response.data.length > 0) {
                    var reservedSeats = [];

                    $.each(response.data, function (index, reservation) {
                        reservedSeats.push({
                            row: parseInt(reservation.row) - 1,
                            col: parseInt(reservation.seat_num) - 1
                        });
                    });

                    initializeSeatchart(reservedSeats);
                } else {
                    alert('No reservations found.');
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX error:', error);
            }
        });
    }

    fetchReservedSeats();

    function initializeSeatchart(reservedSeats) {
        var options = {
            map: {
                rows: 17,
                columns: 16,
                seatTypes: {
                    default: {
                        label: "General",
                        cssClass: "economy",
                        price: 15,
                    },
                    vip1: {
                        label: "VIP 1",
                        cssClass: "first-class",
                        price: 25,
                        seatRows: [14, 15, 16],
                    },
                    vip2: {
                        label: "VIP 2",
                        cssClass: "reduced",
                        price: 10,
                        seatRows: [12, 13],
                    },
                },
                reservedSeats: reservedSeats,
                rowSpacers: [3, 7, 12],
                columnSpacers: [8]
            },
            cart: { currency: "ден", submitLabel: "Reserve" }
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
                e.cart.forEach(function (reservation) {
                    console.log(reservation);
                    $.ajax({
                        url: 'Services/reservation_add.php',
                        type: 'POST',
                        data: {
                            user_id: 4,
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
        });
        sc.addEventListener("cartchange", function handleCartChangeEvent(e) {
            if (sc.getCart().length > 4) {
                alert(`You can only select up to 4 seats.`);
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
$(document).ready(function () {

    function fetchReservedSeats() {
        $.ajax({
            url: 'Services/reservation_get_by_repertoire.php?repertoire_id=2',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                if (response.success && response.data.length > 0) {
                    var reservedSeats = [];

                    $.each(response.data, function (index, reservation) {
                        reservedSeats.push({
                            row: parseInt(reservation.row) - 1,
                            col: parseInt(reservation.seat_num) - 1
                        });
                    });

                    initializeSeatchart(reservedSeats);
                } else {
                    alert('No reservations found.');
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX error:', error);
            }
        });
    }

    fetchReservedSeats();

    function initializeSeatchart(reservedSeats) {
        var options = {
            map: {
                rows: 17,
                columns: 16,
                seatTypes: {
                    default: {
                        label: "General",
                        cssClass: "economy",
                        price: 15,
                    },
                    vip1: {
                        label: "VIP 1",
                        cssClass: "first-class",
                        price: 25,
                        seatRows: [14, 15, 16],
                    },
                    vip2: {
                        label: "VIP 2",
                        cssClass: "reduced",
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
                e.cart.forEach(function (reservation) {
                    console.log(reservation);
                    $.ajax({
                        url: 'Services/reservation_add.php',
                        type: 'POST',
                        data: {
                            user_id: 15,
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
