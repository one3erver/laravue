
@extends('admin.layouts.master')
@section('main')
<section class="section dashboard">

    <div class="row">
        <div class="col-lg-12">
            <div class="row">

                <div class="col-lg-8" >
                    <h4>Do you want to delete this product?</h4>
                    <form method="post" action="{{route('admin.products.destroy',$product)}}">
                        @csrf
                        @method('DELETE')
                        <a  class="btn btn-secondary" href="{{route('admin.products.index')}}">No</a>
                        <button type="submit" class="btn btn-danger">Yes</button>
                    </form>
                </div>
                <div class="card col-lg-4" >
                    <img src="{{ url('images/admin/products/'. $product->image) }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Title = {{$product->title}}</h5>
                        <hr>
                        <p class="card-text">caption = {{$product->caption}}</p>
                        <hr>
                        <p class="list-group-item">price = {{$product->price}}</p>
                        <hr>
                        <p class="list-group-item">stock = {{$product->stock}}</p>
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
