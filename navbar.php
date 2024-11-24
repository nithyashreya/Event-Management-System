<?php
//session_start(); // Start the session
?>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="brand-logo">
            <a href="#home"><img src="images/logo.png" alt="Brand Logo"></a>
        </div>
        <!-- Navigation links for large screens -->
        <ul class="nav-links">
            <li><a href="#eventCarousel">Home</a></li>
            <li><a href="#events">Events</a></li>
            <li><a href="#stats">Stats</a></li>
            <li><a href="#gallery">Gallery</a></li>
        </ul>


        <!-- Hamburger menu for small screens -->
        <div class="hamburger" id="hamburger">
            <span class="mini-bar bar"></span>
            <span class="bar middle-bar"></span>
            <span class="bar mini-bar"></span>
        </div>
        <!-- Overlay Menu for small screens -->
        <div class="menu-overlay" id="menuOverlay">
            <div class="top-section">
                <div class="top-section-logo">
                    <a href="#">
                        <img src="images/logo.png" alt="">
                    </a>
                </div>
                <div class="close-btn" id="closeBtn">X</div>
        </div>
            <ul class="nav-links-overlay">
                <li class="nav-item">
                    <a class="nav-link" href="#events">
                        <i class="material-icons">event</i> Events
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#stats">
                        <i class="material-icons">bar_chart</i> Stats
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#gallery">
                        <i class="material-icons">photo_library</i> Gallery
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="profile.php">
                        <i class="material-icons">person</i> Profile
                    </a>
                </li>
                
            </ul>
        </div>
    </nav>
