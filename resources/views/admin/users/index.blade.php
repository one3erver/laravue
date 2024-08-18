@extends('admin.layouts.master')
@section('main_title')
    <div class="pagetitle">
        <h1>Users</h1>

        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
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
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Is_Admin</th>
                            <th scope="col">Edit</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->phone}}</td>

                            <td>
                                @if ($user->is_admin == 1)
                                    Yes

                                @else
                                    No
                                @endif
                            </td>

                            <td>
                                <a type="button" class="btn btn-success"  href="{{route('admin.users.edit', $user)}}"><i class="ri-ball-pen-line"></i></a>

                            </td>

                        </tr>
                        @endforeach

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


