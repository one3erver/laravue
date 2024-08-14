@extends('panel_admin.layouts.master')
@section('main_title')
    <div class="pagetitle">
        <h1>Products</h1>

        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Product_Management</li>

            </ol>
        </nav>
    </div>
@endsection
@section('main')
        <section class="section dashboard">

            <div class="row">
                <button type="button" class="btn btn-secondary" onclick=" window.open('/panel_admin/add_product')" >ADD CLICK</button>
                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">

                        <!-- Table with stripped rows -->
                        <table class="table table-striped ">
                            <thead>
                            <tr>
                                <th scope="col">Image_thumbnail</th>
                                <th scope="col">Title</th>
                                <th scope="col">Position</th>
                                <th scope="col">Stock</th>
                                <th scope="col">Price</th>


                                <th scope="col">Description</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Remove</th>
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
                                    <!-- Disabled Animation Modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#disabledAnimation">
                                        <div class="icon">
                                            <i class="bx bxs-comment-detail"></i>
                                        </div>
                                    </button>
                                    <div class="modal" id="disabledAnimation" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">title</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Non omnis incidunt qui sed occaecati magni asperiores est mollitia. Soluta at et reprehenderit. Placeat autem numquam et fuga numquam. Tempora in facere consequatur sit dolor ipsum. Consequatur nemo amet incidunt est facilis. Dolorem neque recusandae quo sit molestias sint dignissimos.
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Disabled Animation Modal-->
                                </td>

                                <td>
                                    <button type="button" class="btn btn-success" onclick=" window.open('/panel_admin/update_product')"><i class="ri-ball-pen-line"></i></button>

                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger" onclick=" window.open('/panel_admin/remove_product')"><i class="ri-delete-bin-7-line"></i></button>

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
