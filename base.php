<?php
if (!isset($_SESSION)) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Fastway </title>
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/6320a2a854f06e12d8947b56/1gcrnmpjo';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();

    </script>
    <!--End of Tawk.to Script-->
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


    <!-- Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="css/style.min.css" rel="stylesheet"> -->
    <link href="css/style.css" rel="stylesheet">

</head>

<body>

    <!-- Topbar Start -->
    <div class="container-fluid bg-dark">
        <div class="row py-2 px-lg-5">
            <div class="col-lg-6 text-center text-lg-left mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center text-white">
                    <small><i class="fa fa-phone-alt mr-2"></i>++8801580336034</small>
                    <small class="px-3">|</small>
                    <small><i class="fa fa-envelope mr-2"></i>alamiin.bd@gmail.com</small>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <a class="text-white px-2" href="">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-white px-2" href="">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-white px-2" href="">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-white px-2" href="">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="text-white pl-2" href="">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg navbar-light py-3  px-lg-5" style="background-color: #fff; border-bottom: 1px solid #e9ecef;">
            <a href="index.php" class="navbar-brand ml-lg-3">
                <img src="img/fastway.gif" alt="fastway" height="30px">
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between  px-lg-3" id="navbarCollapse">
                <div class="navbar-nav  ml-auto py-0">
                    <a href="index.php" class="nav-item nav-link ">Home</a>
                    <a href="index.php#service" class="nav-item nav-link ">Service</a>
                    <a href="index.php#price" class="nav-item nav-link ">Price</a>
                    <a href="index.php#about" class="nav-item nav-link ">About</a>
                    <a href="contact.php" class="nav-item nav-link ">Contact</a>

                    <!-- Accessible only to the users that have logged in already -->
                    <?php if (isset($_SESSION['email'])) : ?>
                        <li class="nav-item dropdown show">
                            <a class=" nav-item nav-link" data-toggle="dropdown" aria-expanded="false" href="#">
                                <span>
                                    <div class="d-felx badge-pill">
                                        <span class="fa fa-user mr-2"></span>
                                        <span>Account</span>
                                        <span class="fa fa-angle-down ml-2"></span>
                                    </div>
                                </span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="account_settings" style="left: inherit; right: 0px;">
                                <a class="dropdown-item nav-link" href="profile.php" id=""><i class="fa fa-cog"></i> Profile </a>
                                <a class="dropdown-item nav-link" href="logout.php"><i class="fa fa-power-off"></i> Logout</a>
                            </div>
                        </li>
                    <?php endif ?>

                    <?php if (!isset($_SESSION['email'])) : ?>
                        <a href="login.php" class="nav-item nav-link border-0" type="button">Login</a>
                    <?php endif ?>
                </div>


            </div>
        </nav>

    </div>
    <!-- Navbar End -->



    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-success back-to-top"><i class="fa fa-angle-double-up"></i></a>