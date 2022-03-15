<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Overview - SB Admin Pro</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
        <link href="css/plantilla.css" rel="stylesheet">
        <script src="https://kit.fontawesome.com/52ab0889bc.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.2/umd/popper.min.js" integrity="sha512-aDciVjp+txtxTJWsp8aRwttA0vR2sJMk/73ZT7ExuEHv7I5E6iyyobpFOlEFkq59mWW8ToYGuVZFnwhwIUisKA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <!-- <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script> -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="nav-fixed">
        <div id="app">
            <nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light bg-white" id="sidenavAccordion">
                <!-- Sidenav Toggle Button-->
                <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 me-2 ms-lg-2 me-lg-0" id="sidebarToggle"><i data-feather="menu"></i></button>
                <!-- Navbar Brand-->
                <!-- * * Tip * * You can use text or an image for your navbar brand.-->
                <!-- * * * * * * When using an image, we recommend the SVG format.-->
                <!-- * * * * * * Dimensions: Maximum height: 32px, maximum width: 240px-->
                <a class="navbar-brand pe-3 ps-4 ps-lg-2" href="index.html">SB Admin Pro</a>
                <!-- Navbar Items-->
                <ul class="navbar-nav align-items-center ms-auto">
                    <!-- User Dropdown-->
                    <li class="nav-item dropdown no-caret dropdown-user me-3 me-lg-4">
                        <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="img-fluid" src="assets/img/illustrations/profiles/profile-1.png" /></a>
                        <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
                            <h6 class="dropdown-header d-flex align-items-center">
                                <img class="dropdown-user-img" src="assets/img/illustrations/profiles/profile-1.png" />
                                <div class="dropdown-user-details">
                                    <div class="dropdown-user-details-name">Valerie Luna</div>
                                    <div class="dropdown-user-details-email">vluna@aol.com</div>
                                </div>
                            </h6>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#!">
                                <div class="dropdown-item-icon"><i data-feather="settings"></i></div>
                                Account
                            </a>
                            <a class="dropdown-item" href="#!">
                                <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                                Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <div id="layoutSidenav">
                @include('plantilla.sidebar')
                @yield('contenido')
            </div>
        </div>
        <script src="js/app.js"></script>
        <script src="js/plantilla.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    </body>
</html>
