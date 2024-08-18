@extends('admin.layouts.master')
@section('main_title')
    <div class="pagetitle">
        <h1>Panel_admin</h1>

        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                <li class="breadcrumb-item active">Panel_admin</li>

            </ol>
        </nav>
    </div>
@endsection
@section('main')
    <section class="section dashboard">

        <div class="row">
            <!-- Recent Sales -->
            <div class="col-12">
                <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                    <h4 class="alert-heading">wellcome </h4>
                    <p>Welcome to the admin panel. Please select the desired option from the left sidebar</p>
                </div>
            </div>
        <!-- End Right side columns -->

        </div>
    </section>

@endsection
