<?php
include('connect.php');


?>
<?php
function getInitials($name) {
    $nameParts = explode(' ', $name);
    $initials = '';

    foreach ($nameParts as $part) {
        $initials .= strtoupper(substr($part, 0, 2));
    }
    return $initials;
}
?>
<style>
    
.user-menu {
    position: relative;
    display: inline-block;
}

.user-initials {
    padding: 10px;
    background-color: #ff0000;
    color: #ffffff;
    border-radius: 50%;
    cursor: pointer;
    display: inline-block;
}

.dropdown-menu {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    background-color: black;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    border-radius: 4px;
    overflow: hidden;
    z-index: 1;
}

.dropdown-menu a {
    color: #ff0000;
    padding: 10px 20px;
    text-decoration: none;
    display: block;
}

.dropdown-menu a:hover {
    background-color:black;
}

.user-menu:hover .dropdown-menu {
    display: block;
}
</style>
<header>
        <!--? Header Start -->
        <div class="header-area header-transparent">
            <div class="main-header header-sticky">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <!-- Logo -->
                        <div class="col-xl-2 col-lg-2 col-md-1">
                            <div class="logo">
                                <a href="index.html"><img src="assets/img/logo/logo1 (1).png" alt=""></a>
                            </div>
                        </div>
                        <div class="col-xl-9 col-lg-10">
							<div class="main-menu black-menu menu-bg-white d-none d-lg-block">
								<div class="hamburger hamburger--collapse">
									<div class="hamburger-box">
										<div class="hamburger-inner"></div>
									</div>
								</div>
								<nav class="hamburger-menu">
									<ul id="navigation">
										<li><a href="index.php">Home</a></li>
										<li><a href="about.php">About</a></li>
										<li><a href="services.html">Services</a></li>
	
										<li><a href="contact.php">contact</a></li>
                                        <li>
                                        <div class="user-menu">
        <?php
        if (isset($_SESSION['user_data'])) {
            $userName = $_SESSION['user_data']['username'];
            $userInitials = getInitials($userName);
            echo '<div class="user-initials" style="font-weight:bold;">' . $userInitials . '</div>';
            echo '<div class="dropdown-menu">
                    <a href="logout.php">Logout</a>
                  </div>';
        } else {
            echo '<li><a href="signup.php" >Sign Up</a></li>';
            echo '<span> </span>';
            echo '<li><a href="login.php" >Log In</a></li>';
        }
        ?>
    </div>

               </li>
									</ul>
								</nav>
							</div>
						</div>
                       
                        <!-- Mobile Menu -->
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->
    </header>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop3" tabindex="-1" aria-labelledby="exampleModalLabel3" aria-hidden="true">
    <div class="modal-dialog d-flex justify-content-center">
        <div class="modal-content w-75">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel3">Subscribe</h5>
                <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form>
                    <!-- Name input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="text" id="name3" class="form-control" />
                        <label class="form-label" for="name3">Name</label>
                    </div>

                    <!-- Email input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="email" id="email3" class="form-control" />
                        <label class="form-label" for="email3">Email address</label>
                    </div>

                    <!-- Checkbox -->
                    <div class="form-check d-flex justify-content-center mb-4">
                        <input class="form-check-input me-2" type="checkbox" value="" id="checkbox3" checked />
                        <label class="form-check-label" for="checkbox3">
                            I have read and agree to the terms
                        </label>
                    </div>

                    <!-- Submit button -->
                    <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block">Send</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->