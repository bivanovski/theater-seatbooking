<?php
session_start();
if (!isset($_SESSION['firstname']) || !isset($_SESSION['lastname']) || $_SESSION['role'] !== "admin") {
    return header('Location: login.php?errorMessage=Unauthorized');
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Show Details</title>
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
        <div class="align-items-center d-flex"> <a class="navbar-brand text-uppercase text-dark" href=""><img
                    src="images/logo2.png" alt="Logo" width="70" height="70" class="d-inline-block align-top"></a>
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

<body class="text-white bg-color">
    <div id="wrapper">

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

                <!-- Modal -->
                <div class="modal fade" id="RepertoireModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-dark" id="exampleModalLabel">Add New Repertoire</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="form-group">
                                        <label for="repertoire-date">Repertoire Date:</label>
                                        <input type="date" class="form-control" id="repertoire-date"
                                            name="repertoire-date" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="repertoire-time">Repertoire Time:</label>
                                        <input type="time" class="form-control" id="repertoire-time"
                                            name="repertoire-time" required>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" id="saveRepertoireChanges"
                                    class="btn accent-bg text-light">Add</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Modal -->

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
            $.ajax({
                url: "Services/show_details.php",
                method: "GET",
                data: { show_id: showId },
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        var showData = response.data;
                        $("#show-details-container").html(`
                    
                    <div class="row mb-3">
<div class="col-md-3">
<img src="${showData.image}" class="shadow-sm img-fluid" alt="Show Image">
</div>
<div class="col-md-9">
<div class="row">
<div class="col d-flex justify-content-between">
    <h3 class="accent-color">${showData.name}</h3>
    <div class="">
        <a class="btn text-warning p-0 mr-1" href="show_edit.php?id=${showData.id}"><i class="fa-regular fa-pen-to-square fa-lg"></i></a>
        <button class="btn accent-color p-0 delete-show-btn"><i class="fa-regular fa-trash-can fa-lg"></i></button>
    </div>
</div>
</div>
<h4 class="text-warning  mb-4">${showData.age_group}</h4>
<h4 class="text-dark">Description:</h4>
<p class="text-dark text-justify">${showData.description}</p>
<h5 class="text-dark">Genre: <span class="accent-color">${showData.genre}</span></h5>
<h6 class="text-dark mb-4">Hall Number: <span class="accent-color">${showData.hall_number}</span></h6>
<h4 class="text-dark">Production Crew:</h4>
<div class="row">
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
</div>

</div>
                
<div class="row">
    <div class="col-10">
        <h4 class="text-dark">Repertoires:</h4>
        <div class="mb-3">
            <button type="button" class="btn accent-bg text-light  btn-sm mr-2" data-toggle="modal" data-target="#RepertoireModal">
                <i class="fa-solid fa-plus mr-1"></i>Add New Repertoire
            </button>
        </div>
        <div id="repertoire-container"></div>
    </div>
</div>

                `);
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
            loadRepertoires(showId);

            // Event listener for "Save changes" button in the modal
            $("#saveRepertoireChanges").click(function () {
                // Get the values of the date and time inputs
                var date = $("#repertoire-date").val();
                var time = $("#repertoire-time").val();
                // Combine date and time to form a datetime string
                var dateTime = date + " " + time;
                // Call the addRepertoire function with showId and dateTime
                $.ajax({
                    url: "Services/repertoire_add.php",
                    method: "POST",
                    data: {
                        show_id: showId,
                        date_time: dateTime
                    },
                    dataType: "json",
                    success: function (response) {
                        if (response.success) {
                            // Handle success
                            console.log("Repertoire added successfully");
                            // Reload the page
                            location.reload();
                        } else {
                            // Handle failure
                            console.error("Failed to add repertoire:", response.message);
                        }
                    },
                    error: function (xhr, status, error) {
                        // Handle error
                        console.error("Error adding repertoire:", error);
                    }
                });
                // Close the modal
                $("#RepertoireModal").modal("hide");
            });

            // Click event handler for the "Add New Repertoire" button
            $(document).on("click", "#RepertoireModalButton", function () {
                // Code to open the modal
                $("#RepertoireModal").modal("show");
            });

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
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    confirmButtonColor: "#101010"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'Services/show_delete.php',
                            method: 'POST',
                            data: { show_id: showId },
                            dataType: 'json',
                            success: function (response) {
                                if (response.success) {
                                    Swal.fire({
                                        title: 'Deleted!',
                                        text: response.message,
                                        icon: 'success',
                                        confirmButtonColor: "#101010"
                                    }).then(() => {
                                        window.location.href = 'shows.php';
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: response.message,
                                        icon: 'error',
                                        confirmButtonColor: "#101010"
                                });
                                }
                            },
                            error: function (xhr, status, error) {
                                console.error(xhr.responseText);
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Failed to delete show. Please try again later.',
                                    icon: 'error',
                                    confirmButtonColor: "#101010"
                            });
                            }
                        });
                    }
                });
            });
        });
    </script>
</body>

</html>