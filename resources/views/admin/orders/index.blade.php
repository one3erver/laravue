@use('App\Models\User')
@extends('admin.layouts.master')
@section('main_title')
    <div class="pagetitle">
        <h1>Orders</h1>

        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
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
                                <th scope="col">Tracking_Code</th>
                                <th scope="col">Total_Price</th>
                                <th scope="col">Time</th>

                                <th scope="col">Order_List</th>
                                <th scope="col">remove</th>

                            </tr>
                            </thead>

                            <tbody>
                            @php($i=1)
                            @foreach($orders as $order)
                                @php($usi= User::find($order->user_id))


                            <tr>

                                <td>{{$i++}}</td>
                                <td>{{$usi->name}}</td>
                                <td>{{$order->tracking_code}}</td>
                                <td>{{$order->total_cost}}</td>
                                <td>{{$order->created_at}}</td>

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
                                                    {{$order->order_list}}
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
                                    <form action="{{route('admin.orders.destroy', $order->id )}}" method="post" >
                                        @method('DELETE')
                                        @csrf
                                         <a  class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#smallModal" data-id="7">
                                            <i class="ri-delete-bin-7-line "></i>
                                         </a>
                                         <div class="modal fade" id="smallModal" tabindex="-1"200  data-id>


                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-danger">
                                                                <i class="bi bi-exclamation-octagon me-1"></i>
                                                                 Danger Alert</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete the product?

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger">Delete</button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                </td>
                                <td>

                                </td>

                            </tr>

                            @endforeach
{{--                            icon status--}}
{{--                            <span class="badge bg-danger">Rejected</span></td>--}}
{{--                            <td><span class="badge bg-warning">Pending</span></td>--}}
{{--                            <td><span class="badge bg-success">Approved</span></td>--}}


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
