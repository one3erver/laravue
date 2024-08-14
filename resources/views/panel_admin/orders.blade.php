@extends('panel_admin.layouts.master')
@section('main_title')
    <div class="pagetitle">
        <h1>Orders</h1>

        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Order_Management</li>

            </ol>
        </nav>
    </div>
@endsection

@section('main')
    <section class="section dashboard">

        <div class="row">
            <!-- Recent Sales -->
            <div class="col-12">
                <div class="card recent-sales overflow-auto">

                    <div class="card-body">
                        {{--                        datatable--}}


                        <table class="table   table-borderless">
                            <thead>
                            <tr>
                                <th scope="col">Order_Number</th>
                                <th scope="col">Customer</th>
                                <th scope="col">Invoice</th>
                                <th scope="col">Tracking_Code</th>
                                <th scope="col">Total_Price</th>
                                <th scope="col">Time</th>
                                <th scope="col">Status</th>
                                <th scope="col">Order_List</th>
                                <th scope="col">remove</th>

                            </tr>
                            </thead>

                            <tbody>

                            <tr>

                                <td>3</td>
                                <td>Brandon Jacob</td>
                                <td>455432</td>
                                <td>455432</td>

                                <td>$64</td>
                                <td>2002-5-10</td>
                                <td><span class="badge bg-success">Approved</span></td>
                                <td>
                                    <!-- Disabled Animation Modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#disabledAnimation">
                                        <div class="icon">
                                            <i class="bx ri-folder-open-fill"></i>
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
                                    <button type="button" class="btn btn-danger" onclick=" window.open('/panel_admin/remove_product')"><i class="ri-delete-bin-7-line"></i></button>

                                </td>
                            </tr>
                            <tr>

                                <td>2</td>
                                <td>Bridie Kessler</td>
                                <td>123456</td>
                                <td>123456</td>
                                <td>$47</td>
                                <td>2002-5-10</td>
                                <td><span class="badge bg-warning">Pending</span></td>
                                <td>
                                    <!-- Disabled Animation Modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#disabledAnimation">
                                        <div class="icon">
                                            <i class="bx ri-folder-open-fill"></i>
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
                                    <button type="button" class="btn btn-danger" onclick=" window.open('/panel_admin/remove_product')"><i class="ri-delete-bin-7-line"></i></button>

                                </td>
                            </tr>

                            <tr>

                                <td>1</td>
                                <td>Angus Grady</td>
                                <td>677896</td>
                                <td>677896</td>
                                <td>$67</td>
                                <td>2002-5-10</td>
                                <td><span class="badge bg-danger">Rejected</span></td>
                                <td>
                                    <!-- Disabled Animation Modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#disabledAnimation">
                                        <div class="icon">
                                            <i class="bx ri-folder-open-fill"></i>
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
                                    <button type="button" class="btn btn-danger" onclick=" window.open('/panel_admin/remove_product')"><i class="ri-delete-bin-7-line"></i></button>

                                </td>

                            </tr>

                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
            <!-- End Recent Sales -->
        </div>
        <!-- End Right side columns -->

        </div>
    </section>
@endsection
