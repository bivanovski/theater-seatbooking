<?php
session_start();
if (!isset($_SESSION['firstname']) || !isset($_SESSION['lastname'])) {
    return header('Location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Reservations</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="css/seatchart.css" />
    <!-- Google Fonts -->
    <link rel="stylesheet" href="css/example.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Abel&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/83a2a6ffac.js" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand navbar-dark custom-navbar fixed-top shadow-sm">
            <a class="navbar-brand" href="#">
                <img src="images/logo2.png" alt="Logo" width="70" height="70" class="d-inline-block align-top">
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

        <div class="row d-flex justify-content-center ">
            <div class="col-10 
             shadow-sm p-5">
                <div class="row d-flex justify-content-center mb-2">
                    <h2>My Reservations<i class="fa-solid fa-ticket ml-2 accent-color"></i></h2>
                </div>
                <div class="row d-flex justify-content-center">

                    <div class="accordion col-md-8 col-12" id="accordionExample">

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
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/seatchart@0.1.0/dist/seatchart.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>

        $(document).ready(function () {
            var user_id = <?php echo $_SESSION['id']; ?>;

            fetchUserReservations();

            function fetchUserReservations() {
                $.ajax({
                    url: 'Services/reservation_get_by_user.php?user_id=' + user_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function (response) {
                        if (response.success) {
                            if (response.data.length > 0) {
                                fillAccordion(response.data);
                            } else {
                                $('#accordionExample').html('<div class="text-center" role="alert"><p class="text-muted">You have no reservations yet.</p><a  href="mainpage.php" class="btn btn-outline-danger custom-outline-btn mr-2">Reserve Now</a></div>');
                            }
                        } else {
                            console.error('Error fetching reservations:', response.message);
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('AJAX error:', error);
                    }
                });
            }
            function fillAccordion(reservations) {
                var accordion = $('#accordionExample');
                accordion.empty();

                reservations.forEach(function (reservation, index) {
                    var collapseId = 'collapse' + index;
                    var cardId = 'card' + index;

                    var accordionItem = $('<div class="card">');
                    var accordionHeader = $('<div class="card-header d-flex justify-content-between align-items-center" id="' + cardId + '">');
                    var button = $('<button class="btn btn-link accent-color text-decoration-none" type="button" data-toggle="collapse" data-target="#' + collapseId + '" aria-expanded="true" aria-controls="' + collapseId + '">');
                    button.text(reservation.name + ' - ' + reservation.repertoire_date_time + ' Total: ' + reservation.total_reservations);


                    var confirmedIndicator = $('<span class="badge badge-' + (reservation.reservations[0].is_confirmed === '1' ? 'success' : 'danger') + ' ml-2">' + (reservation.reservations[0].is_confirmed === '1' ? 'Confirmed' : 'Not Confirmed') + '</span>');


                    accordionHeader.append(button);
                    accordionHeader.append(confirmedIndicator);
                    accordionItem.append(accordionHeader);

                    var collapse = $('<div id="' + collapseId + '" class="collapse" aria-labelledby="' + cardId + '" data-parent="#accordionExample">');


                    var cardBody = $('<div class="card-body">');

                    var reservationList = $('<ul class="list-group">');
                    var totalPrice = 0;
                    reservation.reservations.forEach(function (res) {
                        var reservationItem = $('<li class="list-group-item d-flex justify-content-between align-items-center">');
                        reservationItem.append('<i class="fa-solid fa-ticket mr-2 accent-color"></i>');
                        reservationItem.append('<span>Row: ' + res.row + ' - Seat Num: ' + res.seat_num + '</span>');
                        reservationItem.append('<span class="badge primary-bg badge-pill">€' + res.price + '</span>');
                        reservationList.append(reservationItem);

                        totalPrice += parseFloat(res.price);
                    });

                    cardBody.append(reservationList);

                    var totalPriceElement = $('<div class="text-right mt-2 accent-color font-weight-bold">Total Price: €' + totalPrice + '</div>');
                    cardBody.append(totalPriceElement);


                    collapse.append(cardBody);

                    accordionItem.append(collapse);

                    accordion.append(accordionItem);
                });
            }

        });


    </script>


</body>

</html>