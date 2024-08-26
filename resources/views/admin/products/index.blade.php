@extends('admin.layouts.master')
@section('main_title')
    <div class="pagetitle">
        <h1>Products</h1>

        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                <li class="breadcrumb-item active">Product_Management</li>

            </ol>
        </nav>
    </div>
@endsection
@section('main')
        <section class="section dashboard">

            <div class="row">
                <a type="button" class="btn btn-secondary" href="{{route('admin.products.create')}}" >ADD CLICK</a>
                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">

                        <!-- Table with stripped rows -->
                        <table class="table table-striped ">
                            <thead>
                            <tr>
                                <th scope="col">Image</th>
                                <th scope="col">Title</th>
                                <th scope="col">Stock</th>
                                <th scope="col">Price</th>
                                <th scope="col">Status</th>
                                <th scope="col">Description</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Remove</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i=1)
                            @foreach($products as $product)
                            @php($i++)

                            <tr>
                                <th scope="row"><img src="{{ url('images/admin/products/'. $product->image) }}" alt="Profile" class="rounded-circle" width="50" height="50" ></th>
                                <td>{{$product->title}}</td>
                                <td>{{$product->stock !== -1 ? $product->stock : 'Infinity'}}</td>
                                <td>{{$product->price}}</td>
                                <td>
                                    @if ($product->status == 1)
                                        <span class="text-success">Active</span>
                                    @else
                                        <span class="text-danger">Inactive</span>
                                    @endif
                                </td>



                                <td>
                                    <!-- Disabled Animation Modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#disabledAnimation{{$i}}">
                                        <div class="icon">
                                            <i class="bx bxs-comment-detail"></i>
                                        </div>
                                    </button>
                                    <div class="modal" id="disabledAnimation{{$i}}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">title</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    {{$product->caption}}
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
                                    <a type="button" class="btn btn-success" href="{{route('admin.products.edit', $product)}}" ><i class="ri-ball-pen-line"></i></a>

                                </td>

                                <td>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#smallModal{{$i}}">
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
                                                    Do you want to delete this product?
                                                </div>
                                                <div class="modal-footer">
                                                    <form method="post" action="{{route('admin.products.destroy', $product)}}">
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
