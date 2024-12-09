<?php // Ensure this is at the top of the file
include("config.php");
?>

<header class="header">
<section class="flex">
    <div id="menu-btn" class="fas fa-bars-staggered"></div>
    <a href="home.php" class="logo"><i class="fas fa-bariefcase"></i>
        <img src="img/jg1.jpg" alt="Job Guru Logo"/></a>

    <nav class="navbar">
        <a href="home.php">home</a>
        <a href="about.php">about us</a>
        <a href="jobs.php">all jobs</a>
        <a href="contact.php">contact us</a>

        
    </nav>

    <div class="auth-buttons">

        <?php
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
            echo " 
            <div class='auth-buttons'>
                <div class='dropdown'>
                    <button class='btn'> {$_SESSION['username']} </button>
                    <div class='dropdown_content'>
                        <a href='user_profile.php'>Profile</a>
                        <a href='update_password.php'>Update Password</a>
                        <a href='logout.php'>Log out</a>
                    </div>
                </div>
            </div>
            ";
        } else {
            echo"
            <a href='login.php' class='btn' style='margin-top: 0; margin-left: 10px;'>Log in </a>
            ";
        }
        ?>

        
    </div>
</section>
</header>
