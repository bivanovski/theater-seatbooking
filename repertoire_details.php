<!DOCTYPE html>
<html>

<head>
    <title>Repertoire Details</title>
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
    <link rel="stylesheet" href="css/seatchart.css" />
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

                            <div class="col-10 card p-4 shadow-sm">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="text-dark">Title Of The Show - <span class="accent-color">14/01/2023
                                                18:00</span></h2>
                                        <div id="container" class="text-dark"></div>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="text-dark">Reservations</h2>
                                        <div id="accordion" class="accordion">
                                        </div>
                                    </div>

                                </div>


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
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/seatchart@0.1.0/dist/seatchart.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/admin.js"></script>
    <script>
       $(document).ready(function () {
    var repertoireId = <?php echo $_GET['id'];?>;

    function fetchReservedSeats() {
        $.ajax({
            url: 'Services/reservation_get_by_repertoire.php',
            type: 'GET',
            data: { repertoire_id: repertoireId },
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
                    // alert('No reservations found.');
                    initializeSeatchart();
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX error:', error);
            }
        });
    }

    fetchReservedSeats();

    function initializeSeatchart(reservedSeats = []) {
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
            cart: { visible: false }
        };

        var element = document.getElementById("container");
        var sc = new Seatchart(element, options);
        var frontDiv = document.querySelector(".sc-front");
        frontDiv.textContent = "Stage";
        var title = document.querySelector(".sc-cart-title");
        title.style.display = "none";
    }

    function fetchReservations() {
        $.ajax({
            url: 'Services/reservation_get_by_rep_groupedBy_user.php', // Replace 'path_to_your_php_script.php' with the actual path to your PHP script
            type: 'GET',
            data: { repertoire_id: repertoireId },
            dataType: 'json',
            success: function (response) {
                if (response.success && response.data.length > 0) {
                    fillAccordion(response.data);
                } else {
                    console.log('No reservations found.');
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX error:', error);
            }
        });
    }

    function fillAccordion(data) {
        var accordion = $('#accordion');
        accordion.empty();
        data.forEach(function (userReservation) {
            var userAccordionItem = $('<div class="card text-dark">');
            var header = $('<div class="card-header d-flex justify-content-between" id="heading' + userReservation.user_id + '">');
            var nameContainer = $('<div class="d-flex align-items-center">');
            var name = $('<h6 class="mb-0 me-auto">');
            var toggle = $('<div class="custom-control custom-switch">');
            var switchInput = $('<input type="checkbox" class="custom-control-input" id="customSwitch' + userReservation.user_id + '">');
            var switchLabel = $('<label class="custom-control-label" for="customSwitch' + userReservation.user_id + '">Toggle</label>');
            var button = $('<button class="btn btn-link" data-toggle="collapse" data-target="#collapse' + userReservation.user_id + '" aria-expanded="false" aria-controls="collapse' + userReservation.user_id + '">');

            name.text(userReservation.first_name + ' ' + userReservation.last_name);
           
            button.append(name.clone());
            header.append(button);
            header.append(nameContainer);
            toggle.append(switchInput);
            toggle.append(switchLabel);
            nameContainer.append(toggle);
            
            

            var collapse = $('<div id="collapse' + userReservation.user_id + '" class="collapse" aria-labelledby="heading' + userReservation.user_id + '" data-parent="#accordion">');
            var body = $('<div class="card-body">');

            var reservationList = $('<ol>');
            userReservation.reservations.forEach(function (reservation) {
                var listItem = $('<li>');
                listItem.text('Row: ' + reservation.row + ', Seat: ' + reservation.seat_num);
                reservationList.append(listItem);
            });

            body.append(reservationList);
           collapse.append(body);
            userAccordionItem.append(header);
            userAccordionItem.append(collapse);

            accordion.append(userAccordionItem);

            
            switchInput.click(function () {
                if (switchInput.is(':checked')) {
                    
                    console.log('Reservation confirmed for user ' + userReservation.user_id);
                } else {
                   
                    console.log('Reservation confirmation cancelled for user ' + userReservation.user_id);
                }
            });
        });
    }

    fetchReservations();
});
    </script>
</body>

</html>