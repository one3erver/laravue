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
                        <h4 class="alert-heading"> </h4>
                        <form class="row g-3" method="post" action="{{route('logout')}}">
                            @csrf
                            @method('POST')
                            <p>Are you sure you want to do this?</p>
                            <div class="modal-footer">
                                <a  class="btn btn-secondary" href="{{route('admin.orders.index')}}">No</a>
                                <button type="submit" class="btn btn-danger">Yes</button>
                             </div>
                        </form>
                    </div>
                </div>
                <!-- End Right side columns -->

            </div>
        </section>

    @endsection

