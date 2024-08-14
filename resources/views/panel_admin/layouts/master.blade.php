<!-- ======= Header ======= -->
@include('panel_admin.layouts.header')
<!-- End Header -->

<!-- ======= Sidebar ======= -->
@include('panel_admin.layouts.sidbar')
<!-- End Sidebar-->
<main id="main" class="main">

@yield('main_title')
    <!-- End Page Title -->

@yield('main')
</main><!-- End #main -->
<!-- ======= Footer ======= -->
@include('panel_admin.layouts.footer')
<!-- End Footer -->


