<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premiere</title>
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
        body{
            background-color: #c79da4;
        }
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
    <section class="premiers-background">
        <img src="https://novamakedonija.com.mk/wp-content/uploads/2022/12/mnt.jpg"
            alt="Theater Background" class="img-fluid" style="width: 100%; height: auto;">
    </section>

    
    <div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h1 style="font-family: 'Arial', sans-serif; color: #333; font-weight: bold; text-transform: uppercase; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);">Agava by Baghi</h1>
            <p style="font-size: 18px; color: #666; font-weight: bold;">Drama | Duration: 120 min | Age group: 12+</p>
            <h3 style="text-decoration: underline; color: black; font-weight: bold;">About the show</h3>
            <p style="font-family:Arial, Helvetica, sans-serif; font-size: 18px; color: #444; line-height: 1.6; letter-spacing: 0.5px;">"Agava by Baghi" is a captivating spectacle that transports audiences into a realm of mesmerizing beauty and enchantment. With its breathtaking visuals, innovative storytelling, and dynamic performances, this production immerses viewers in a world where imagination knows no bounds.</p>
            <p style="font-family:Arial, Helvetica, sans-serif; font-size: 18px; color: #444; line-height: 1.6; letter-spacing: 0.5px;">From the moment the curtains rise, audiences are drawn into a spellbinding journey filled with wonder and excitement. Through a seamless fusion of music, dance, and theatricality, "Agava by Baghi" unfolds a narrative that unfolds like a vibrant tapestry, weaving together the threads of fantasy and reality.</p>
            <p style="font-family:Arial, Helvetica, sans-serif; font-size: 18px; color: #444; line-height: 1.6; letter-spacing: 0.5px;">As the characters traverse through landscapes both magical and mysterious, each scene unfolds with a sense of awe and wonder, leaving spectators on the edge of their seats. With every movement, every note, and every word spoken, the performers breathe life into the story, igniting the imagination and stirring the soul.</p>
            
        </div>
    </div>
</div>
<div class="container mt-5">
       
        <button class ="custom-button">
        
                    </buttton>
                    <div class="container">
  
  <button type="button" class="btn btn-info" > 16 April, 19:00</button>
  

   
    </div>


    
</body>
</html>

