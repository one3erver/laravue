
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

<body>

<!-- ======= Header ======= -->
@include('panel_admin.layouts.header')
<!-- End Header -->

<!-- ======= Sidebar ======= -->
@include('panel_admin.layouts.sidbar')
<!-- End Sidebar-->

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Product_management</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Product_management</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <!-- Table with stripped rows -->
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Image_thumbnail</th>
                            <th scope="col">Title</th>
                            <th scope="col">Position</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Price</th>
                            <th scope="col">Edit</th>
                            <th scope="col">remove</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row"><img src="image/profile-img.jpg" alt="Profile" class="rounded-circle" width="50" height="50" ></th>
                            <td>Brandon Jacob</td>
                            <td>show</td>
                            <td>28</td>
                            <td>200</td>
                            <td>
                                <i class="ri-ball-pen-line"></i>
                            </td>
                            <td>
                                <i class="ri-delete-bin-7-line"></i>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Bridie Kessler</td>
                            <td>show</td>
                            <td>35</td>
                            <td>200</td>
                            <td class="">
                                <i class="ri-ball-pen-line"></i>
                            </td>
                            <td>
                                <i class="ri-delete-bin-7-line"></i>
                                </td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Ashleigh Langosh</td>
                            <td>show</td>
                            <td>45</td>
                            <td>200</td>
                            <td>
                                <i class="ri-ball-pen-line">

                                </i>
                            </td>
                            <td>
                                <i class="ri-delete-bin-7-line"></i>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">4</th>
                            <td>Angus Grady</td>
                            <td>show</td>
                            <td>34</td>
                            <td>200</td>
                            <td>
                                <i class="ri-ball-pen-line">

                                </i>
                            </td>
                            <td>
                                <i class="ri-delete-bin-7-line"></i>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">5</th>
                            <td>Raheem Lehner</td>
                            <td>show</td>
                            <td>47</td>
                            <td>200</td>
                            <td>
                                <i class="ri-ball-pen-line"></i>
                            </td>
                            <td>
                                <i class="ri-delete-bin-7-line"></i>

                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->
                </div>
            </div>
            <!-- End Left side columns -->

            <!-- Right side columns -->






            </div>
        <!-- End Right side columns -->

        </div>
    </section>

</main><!-- End #main -->

<!-- ======= Footer ======= -->
@include('panel_admin.layouts.footer')
<!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="/vendor/apexcharts/apexcharts.min.js"></script>
<script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/vendor/chart.js/chart.umd.js"></script>
<script src="/vendor/echarts/echarts.min.js"></script>
<script src="/vendor/quill/quill.min.js"></script>
<script src="/vendor/simple-datatables/simple-datatables.js"></script>
<script src="/vendor/tinymce/tinymce.min.js"></script>
<script src="/vendor/php-email-form/validate.js"></script>
<script src="/vendor/tinymce/license.txt"></script>



<!-- Template Main JS File -->
<script src="/js/main.js"></script>

</body>

</html>
