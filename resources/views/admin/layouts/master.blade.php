<!-- ======= Header ======= -->
@include('admin.layouts.header')
<!-- End Header -->

<!-- ======= Sidebar ======= -->
@include('admin.layouts.sidbar')
<!-- End Sidebar-->
<main id="main" class="main">

    @yield('main_title')
    <!-- End Page Title -->

    @yield('main')
</main><!-- End #main -->
<!-- ======= Footer ======= -->
@include('admin.layouts.footer')
<!-- End Footer -->


