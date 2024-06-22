<?php

include 'connect.php';

$result = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['trackingid'])) {
        $id = $_POST["trackingid"];
        $sql = "SELECT * FROM `sender` WHERE `track_id` = '$id'";
        $result = mysqli_query($coni, $sql);

        if ($result === false) {
            die("Query failed: " . mysqli_error($coni));
        }
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Track Your Package</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
   

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>
<style>
    html
    {
        scroll-behavior: smooth;
    }
    .whatsapp_float {
      position: fixed;
      width: 60px;
      height: 60px;
      bottom: 40px;
      right: 40px;
      background-color: #25d366;
      color: #fff;
      border-radius: 50px;
      text-align: center;
      font-size: 30px;
      box-shadow: 2px 2px 3px #999;
      z-index: 100;
    }
    .whatsapp-icon {
      margin-top: 16px;
    }

    /* for mobile */
    @media screen and (max-width: 767px){
      .whatsapp-icon {
        margin-top: 10px;
      }
      .whatsapp_float {
        width: 40px;
        height: 40px;
        bottom: 20px;
        right: 10px;
        font-size: 22px;
      }
    }
    #logo img {
            max-width: 100%;
            height: auto;
        }

        @media (max-width: 576px) {
            #logo {
                margin-left: 0 !important;
                text-align: center;
                width: 100%;
            }
        }
        @media (max-width: 768px) {
        #singlebox img, #combobox img {
            width: 100%;
            height: auto;
        }
    }
        @media (max-width: 768px) {
            .col-md-4 {
                margin-left: 0 !important;
            }
        }
        @media (max-width: 768px) {
        #drum img , #drumbuilt img{
            width: 100%;
            height: auto;
        }
    }
        @media (max-width: 768px) {
            .col-md-4 {
                margin-left: 0 !important;
            }
        }
        @media (max-width: 768px) {
        #aircargo img {   
            width: 100%;
            height: auto;
        }
    }
    
</style>
<body>
    <!-- Topbar Start -->
    <div class="container-fluid bg-dark">
        <div class="row py-2 px-lg-5">
            <div class="col-lg-6 text-center text-lg-left mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center text-white">
                    <small><i class="fa fa-phone-alt mr-2"></i>+971 56 505 6023</small>
                    <small class="px-3">|</small>
                    <small><i class="fa fa-envelope mr-2"></i>bayanihan@ozarashipping.com</small>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <a class="text-white px-2" href="https://www.facebook.com/people/Bayanihan-Express-Cargo/61560015580145/">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-white px-2" href="">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-lg-5">
            <a href="index.html" class="navbar-brand ml-lg-3" id="logo">
               <img src="img/logo.png">
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between px-lg-3" id="navbarCollapse">
                <div class="navbar-nav m-auto py-0">
                    <a href="index.html" class="nav-item nav-link active">Home</a>
                    <a href="about.html" class="nav-item nav-link">About</a>
                    <a href="index.html#pricing" class="nav-item nav-link">Price</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Services</a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="landfreight.html" class="dropdown-item">Land Freights</a>
                            <a href="seafreight.html" class="dropdown-item">Sea Freights</a>
                            <a href="airfreight.html" class="dropdown-item">Air Freights</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Ecommerce solutions</a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="cod.html" class="dropdown-item">Cash on delivery</a>
                        </div>
                    </div>
                    <a href="contact.html" class="nav-item nav-link">Contact</a>
                    
                    <a href="https:/wa.me/971553454629"  target="_blank" class="whatsapp_float"><i class="fa-brands fa-whatsapp whatsapp-icon"></i></a>

                </div>
                <a href="https:/wa.me/971553454629" class="btn btn-primary py-2 px-4 d-none d-lg-block">Get A Quote</a>
            </div>
        </nav>
    </div>

    <!-- Header Start -->
    <div class="jumbotron jumbotron-fluid mb-5">
        <div class="container text-center py-5">
            <h1 class="text-white display-3">Track Your Package</h1>
            <div class="d-inline-flex align-items-center text-white">
                <p class="m-0"><a class="text-white" href="">Home</a></p>
                <i class="fa fa-circle px-3"></i>
                <p class="m-0">Track Your Package</p>
            </div>
        </div>
    </div>
    <!-- Header End -->
    <div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Your <b>Package</b></h2>
                    </div>
                    
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Package Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Dispatched</th>
                        
                      
                    </tr>
                </thead>
                <tbody>
                    <?php

                        if ($result === false) {
                            die("Query failed: " . mysqli_error($coni));
                        }

                        $rowCount = mysqli_num_rows($result);

                        if ($rowCount > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $id = $row['id'];
                                $name = $row['name'];
                                $email = $row['email'];
                                $status = $row['status'];
                                $dispatch = $row['dispatch'];

                                echo '<tr>
                                        <td scope="row">' . $id . '</td>
                                        <td>' .  $name . '</td>
                                        <td>' . $email . '</td>
                                        <td>' . $status . '</td>
                                        <td>' . $dispatch . '</td>
                                       
                                    </tr>';
                            }
                        } else {
                            echo "<tr><td colspan='6'>No record found.</td></tr>";
                        }
                    ?> 
                </tbody>
            </table>
        </div>
        </html>