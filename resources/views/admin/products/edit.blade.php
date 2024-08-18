
@extends('admin.layouts.master')
@section('main_title')
    <div class="pagetitle">
        <h1>Product_Update</h1>

        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                <li class="breadcrumb-item active">Product_Update</li>

            </ol>
        </nav>
    </div>
@endsection
@section('main')
    <form class="row g-3" method="post" enctype="multipart/form-data"  action="{{route('admin.products.update',$product)}}">
        @method('PUT')
        <div class="col-md-5">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" required value="{{$product->title}}">
        </div>
        @csrf
        <div class="col-md-5">
            <label for="stock" class="form-label">stock</label>
            <input type="number" class="form-control" id="stock" name="stock"  required value="{{$product->stock}}">
        </div>
        <div class="col-md-5">
            <label for="price" class="form-label">price</label>
            <input type="number" class="form-control" id="price" name="price" required value="{{$product->price}}">
        </div>
        <div class="col-md-5">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image" value="{{$product->image}}">
        </div>
        @if ($product->status == 0)

            <fieldset class="col-md-5">
                <legend class="col-form-label col-sm-2 pt-0">position</legend>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="active" value="0" checked>
                        <label class="form-check-label" for="active">
                            active
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="inactive" value="1">
                        <label class="form-check-label" for="inactive">
                            inactive
                        </label>
                    </div>
                </div>
            </fieldset>
        @else

            <fieldset class="col-md-5">
                <legend class="col-form-label col-sm-2 pt-0">position</legend>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="active" value="0" >
                        <label class="form-check-label" for="active">
                            active
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="inactive" value="1" checked>
                        <label class="form-check-label" for="inactive">
                            inactive
                        </label>
                    </div>
                </div>
            </fieldset>
        @endif
        <div class="col-md-5">
            <img src="{{$product->image}}" alt="Profile" class="rounded-circle" width="100" height="100" >
        </div>

        <div class="col-md-12">
            <label for="caption" class="form-label">caption</label>
            <textarea class="form-control" placeholder="Leave a comment here"  id="caption" name="caption"  style="height: 100px;" required >{{$product->caption}}</textarea>
        </div>



        <div class="col-12">
            <button class="btn btn-primary" type="submit">Submit form</button>
        </div>
    </form>
@endsection
