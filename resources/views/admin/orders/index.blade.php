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
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#unpaid-delete">
                    Delete Unpaid
                </button>

                <div class="modal fade" id="unpaid-delete" tabindex="-1">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">warring</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Do you want to delete this order?
                            </div>
                            <div class="modal-footer">
                                <form method="post" action="{{route('admin.orders.delete-unpaid')}}" >
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12">
                <div class="card recent-sales overflow-auto">

                    <div class="card-body">


                        <table class="table   table-borderless">
                            <thead>
                            <tr>
                                <th scope="col">Customer</th>
                                <th scope="col">Tracking_Code</th>
                                <th scope="col">Total_Price</th>
                                <th scope="col">Time</th>
                                <th scope="col">Status</th>
                                <th scope="col">Paid_at</th>

                                <th scope="col">Order_List</th>
                                <th scope="col">remove</th>

                            </tr>
                            </thead>

                            <tbody>
                            @php($i=1)
                            @foreach($orders as $order)
                                @php($usi= User::find($order->user_id))
                                @php($i++)

                                    <tr>
                                    <td>{{$usi->name}}</td>
                                    <td>{{$order->tracking_code}}</td>
                                    <td>{{$order->total_cost}}</td>
                                    <td>{{$order->created_at}}</td>
    {{--                                <td>{{ $order->invoice ? ($order->invoice->status == "P" ? 'Paid' : 'Unpaid') : '-'  }}</td>--}}
                                    <td>{!! $order->invoice ? ($order->invoice->status == "P" ? '<span class="badge bg-success">Approved</span>' : '<span class="badge bg-danger">Rejected</span>') : '-'  !!}</td>

                                    <td>{{ $order->invoice->paid_at ?? '-'  }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#largeModal{{$i}}">
                                            <i class="bx ri-folder-open-fill"></i>
                                        </button>

                                        <div class="modal fade" id="largeModal{{$i}}" tabindex="-1">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Order List</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">

                                                            <?php
                                                            $g=1;
                                                            $pi=$order->order_list;
                                                            $pro = json_decode($pi, true);
                                                            ?>

                                                        <table class="table table-striped ">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th scope="col">title</th>
                                                                                    <th scope="col">price</th>
                                                                                    <th scope="col">count</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>

                                                                            <?php
                                                                            if (isset($pro['products']) && is_array($pro['products'])) {
                                                                                $g++;
                                                                                foreach ($pro['products'] as $index => $product) {
                                                                                    if (is_array($product)) {

                                                                                        $id = $product['id'] ;
                                                                                        $price = $product['price'];
                                                                                        $title = $product['title'];
                                                                                        $count = $product['count'];

                                                                                        // Use $id, $price, $title, $count safely
                                                                                        if ($id === null || $price === null || $title === null || $count === null) {
                                                                                            echo "Product at index $index is missing some values.";
                                                                                        } else {
                                                                                            ?>
                                                                                            <tr>
                                                                                                <td><?php echo $title ?></td>
                                                                                                <td><?php echo $price ?></td>
                                                                                                <td><?php echo $count ?></td>
                                                                                            </tr>

                                                                                            <?php
                                                                                        }
                                                                                    } else {
                                                                                        echo "Product at index $index is not an array.";
                                                                                    }
                                                                                }
                                                                            }
                                                                                if (isset($pro['totalCost'])) {
                                                                                    $total=$pro['totalCost'];
                                                                              ?>
                                                                                    <tr>
                                                                                        <td >
                                                                                               Total Cost : <?php echo $total ?>$
                                                                                        </td>
                                                                                    </tr>
                                                                             <?php
                                                                                }
                                                                                ?>


                                                                            </tbody>
                                                                        </table>
                                                    </div>



                                                </div>

                                            </div>
                                        </div>

                                    </td>
        <td>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#smallModal{{$i}}"
                                                    @if($order->invoice && $order->invoice->status === 'P') disabled @endif>
                                                <i class="ri-delete-bin-7-line "></i>
                                            </button>

                                            <div class="modal fade" id="smallModal{{$i}}" tabindex="-1">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">warring</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Do you want to delete this order?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form method="post" action="{{route('admin.orders.destroy',$order)}}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-danger">Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
            <!-- End Recent Sales -->
        </div>
        <!-- End Right side columns -->

    </section>
    {{--                            icon status--}}
    {{--                            <span class="badge bg-danger">Rejected</span></td>--}}
    {{--                            <td><span class="badge bg-warning">Pending</span></td>--}}
    {{--                            <td><span class="badge bg-success">Approved</span></td>--}}
@endsection
