
@extends('admin.layouts.master')
@section('main')
    <section class="section dashboard">

        <div class="row">
            <div class="col-lg-12">
                <div class="row">

                    <div class="col-lg-8" >
                        <h4>Do you want to delete this order?</h4>
                        <form method="post" action="{{route('admin.orders.destroy',$order)}}">
                            @csrf
                            @method('DELETE')
                            <a  class="btn btn-secondary" href="{{route('admin.orders.index')}}">No</a>
                            <button type="submit" class="btn btn-danger">Yes</button>
                        </form>
                    </div>
                    <div class="card col-lg-4" >
                        <div class="card-body">
                            <h5 class="card-title">name = {{$order->user->name}}</h5>
                            <hr>
                            <p class="card-text">total_cost = {{$order->total_cost}}</p>
                            <hr>
                            <p class="list-group-item">order_list = {{$order->order_list}}</p>
                            <hr>
                            <p class="list-group-item">tracking_code = {{$order->tracking_code}}</p>
                        </div>
                    </div>

                </div>
            </div>
            <!-- End Left side columns -->

            <!-- Right side columns -->






        </div>
        <!-- End Right side columns -->

        </div>
    </section>
@endsection
