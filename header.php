<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>CLUB</title>
    <meta content="CLUB" property="og:title" />
    <meta content="CLUB" property="twitter:title" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />

    <!-- Bootstrap CSS -->

    <!-- Bootstrap JS and Popper.js -->
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin="anonymous" />
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="club.css">
</head>

<body class="body">
    <nav class="navbar navbar-expand-md py-0" id="navbar_sticky">
        <div class="container-fluid">
            <a href="index.php" class="navbar-brand text-light">Brand</a>
            <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <!-- <li class="nav-item"><a href="index.php" class="nav-link text-light">Home</a></li> -->
                    <li class="nav-item"><a href="about.php" class="nav-link text-light">About</a></li>
                    <li class="nav-item"><a href="services.php" class="nav-link text-light">Services</a></li>
                    <li class="nav-item"><a href="club.php" class="nav-link text-light">Clubs</a></li>
                    <li class="nav-item"><a href="contact.php" class="nav-link text-light">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <script>
        window.onscroll = function() {
            myFunction()
        };
        var navbar_sticky = document.getElementById("navbar_sticky");
        var sticky = navbar_sticky.offsetTop;
        var navbar_height = document.querySelector('.navbar').offsetHeight;

        function myFunction() {
            if (window.pageYOffset >= sticky + navbar_height) {
                navbar_sticky.classList.add("sticky")
                document.body.style.paddingTop = navbar_height + 'px';
            } else {
                navbar_sticky.classList.remove("sticky");
                document.body.style.paddingTop = '0'
            }
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const currentLocation = location.href;
            const menuItem = document.querySelectorAll('.nav-link text-light');

            menuItem.forEach((item) => {
                item.classList.remove('active'); // Remove 'active' class from all nav-link text-lights
                if (item.href === currentLocation) {
                    item.classList.add('active'); // Add 'active' class to the current page's nav-link text-light
                }
            });
        });
    </script>

   