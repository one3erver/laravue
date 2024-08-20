
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dashboard - NiceAdmin Bootstrap Template</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">


    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">



    <!-- Vendor CSS Files -->
    <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="/vendor/simple-datatables/style.css" rel="stylesheet">




    <!-- Template Main CSS File -->
    <link href="/css/style.css" rel="stylesheet">

    <!-- =======================================================
    * Template Name: NiceAdmin
    * Updated: Jul 27 2023 with Bootstrap v5.3.1
    * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
</head>
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="{{ route('admin.dashboard') }}" class="logo d-flex align-items-center">
            <img src="assets/img/logo.png" alt="">
            <span class="d-none d-lg-block">NiceAdmin</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->



    <!-- End Search Bar -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle " href="#">
                    <i class="bi bi-search"></i>
                </a>
            </li>
            <!-- End Search Icon-->

{{--            <li class="nav-item dropdown">--}}

{{--                <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">--}}
{{--                    <i class="bi bi-bell"></i>--}}
{{--                    <span class="badge bg-primary badge-number">4</span>--}}
{{--                </a><!-- End Notification Icon -->--}}

{{--                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">--}}
{{--                    <li class="dropdown-header">--}}
{{--                        You have 4 new notifications--}}
{{--                        <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <hr class="dropdown-divider">--}}
{{--                    </li>--}}

{{--                    <li class="notification-item">--}}
{{--                        <i class="bi bi-exclamation-circle text-warning"></i>--}}
{{--                        <div>--}}
{{--                            <h4>Lorem Ipsum</h4>--}}
{{--                            <p>Quae dolorem earum veritatis oditseno</p>--}}
{{--                            <p>30 min. ago</p>--}}
{{--                        </div>--}}
{{--                    </li>--}}

{{--                    <li>--}}
{{--                        <hr class="dropdown-divider">--}}
{{--                    </li>--}}

{{--                    <li class="notification-item">--}}
{{--                        <i class="bi bi-x-circle text-danger"></i>--}}
{{--                        <div>--}}
{{--                            <h4>Atque rerum nesciunt</h4>--}}
{{--                            <p>Quae dolorem earum veritatis oditseno</p>--}}
{{--                            <p>1 hr. ago</p>--}}
{{--                        </div>--}}
{{--                    </li>--}}

{{--                    <li>--}}
{{--                        <hr class="dropdown-divider">--}}
{{--                    </li>--}}

{{--                    <li class="notification-item">--}}
{{--                        <i class="bi bi-check-circle text-success"></i>--}}
{{--                        <div>--}}
{{--                            <h4>Sit rerum fuga</h4>--}}
{{--                            <p>Quae dolorem earum veritatis oditseno</p>--}}
{{--                            <p>2 hrs. ago</p>--}}
{{--                        </div>--}}
{{--                    </li>--}}

{{--                    <li>--}}
{{--                        <hr class="dropdown-divider">--}}
{{--                    </li>--}}

{{--                    <li class="notification-item">--}}
{{--                        <i class="bi bi-info-circle text-primary"></i>--}}
{{--                        <div>--}}
{{--                            <h4>Dicta reprehenderit</h4>--}}
{{--                            <p>Quae dolorem earum veritatis oditseno</p>--}}
{{--                            <p>4 hrs. ago</p>--}}
{{--                        </div>--}}
{{--                    </li>--}}

{{--                    <li>--}}
{{--                        <hr class="dropdown-divider">--}}
{{--                    </li>--}}
{{--                    <li class="dropdown-footer">--}}
{{--                        <a href="#">Show all notifications</a>--}}
{{--                    </li>--}}

{{--                </ul><!-- End Notification Dropdown Items -->--}}

{{--            </li>--}}
{{--            <!-- End Notification Nav -->--}}

{{--            <li class="nav-item dropdown">--}}

{{--                <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">--}}
{{--                    <i class="bi bi-chat-left-text"></i>--}}
{{--                    <span class="badge bg-success badge-number">3</span>--}}
{{--                </a><!-- End Messages Icon -->--}}

{{--                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">--}}
{{--                    <li class="dropdown-header">--}}
{{--                        You have 3 new messages--}}
{{--                        <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <hr class="dropdown-divider">--}}
{{--                    </li>--}}

{{--                    <li class="message-item">--}}
{{--                        <a href="#">--}}
{{--                            <img src="assets/img/messages-1.jpg" alt="" class="rounded-circle">--}}
{{--                            <div>--}}
{{--                                <h4>Maria Hudson</h4>--}}
{{--                                <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>--}}
{{--                                <p>4 hrs. ago</p>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <hr class="dropdown-divider">--}}
{{--                    </li>--}}

{{--                    <li class="message-item">--}}
{{--                        <a href="#">--}}
{{--                            <img src="assets/img/messages-2.jpg" alt="" class="rounded-circle">--}}
{{--                            <div>--}}
{{--                                <h4>Anna Nelson</h4>--}}
{{--                                <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>--}}
{{--                                <p>6 hrs. ago</p>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <hr class="dropdown-divider">--}}
{{--                    </li>--}}

{{--                    <li class="message-item">--}}
{{--                        <a href="#">--}}
{{--                            <img src="assets/img/messages-3.jpg" alt="" class="rounded-circle">--}}
{{--                            <div>--}}
{{--                                <h4>David Muldon</h4>--}}
{{--                                <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>--}}
{{--                                <p>8 hrs. ago</p>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <hr class="dropdown-divider">--}}
{{--                    </li>--}}

{{--                    <li class="dropdown-footer">--}}
{{--                        <a href="#">Show all messages</a>--}}
{{--                    </li>--}}

{{--                </ul><!-- End Messages Dropdown Items -->--}}

{{--            </li>--}}
{{--            <!-- End Messages Nav -->--}}

            <!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header>
<body>
