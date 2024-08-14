@extends('panel_admin.layouts.master')
@section('main_title')
    <div class="pagetitle">
        <h1>Users</h1>

        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">user_Management</li>

            </ol>
        </nav>
    </div>
@endsection
@section('main')
    <section class="section dashboard">

        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">

                    <!-- Table with stripped rows -->
                    <table class="table table-striped ">
                        <thead>
                        <tr>
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Password</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Is_Admin</th>
                            <th scope="col">Edit</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row"><img src="image/profile-img.jpg" alt="Profile" class="rounded-circle" width="50" height="50" ></th>
                            <td>Brandon Jacob</td>
                            <td>123456</td>
                            <td>Brandon Jacob@gmail.com</td>
                            <td>0912313322</td>

                            <td>True</td>

                            <td>
                                <button type="button" class="btn btn-success" onclick=" window.open('/panel_admin/update_user')"><i class="ri-ball-pen-line"></i></button>

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
@endsection


