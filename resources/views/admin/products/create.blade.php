@extends('admin.layouts.master')
@section('main_title')
    <div class="pagetitle">
        <h1>Product_Add</h1>

        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                <li class="breadcrumb-item active">Product_Add</li>

            </ol>
        </nav>
    </div>
@endsection
@section('main')
    <form class="row g-3" method="post" enctype="multipart/form-data"  action="{{route('admin.products.store')}}">


        <div class="col-md-5">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" >
            @if ($errors->has('title'))
                <div class="alert alert-danger">{{ $errors->first('title') }}</div>
            @endif
        </div>
        @csrf
        <div class="col-md-5">
            <label for="stock" class="form-label">stock</label>
            <input type="number" class="form-control" id="stock" name="stock">
            @if ($errors->has('stock'))
                <div class="alert alert-danger">{{ $errors->first('stock') }}</div>
            @endif
        </div>
        </div>
        <div class="col-md-5">
            <label for="price" class="form-label">price</label>
            <input type="number" class="form-control" id="price" name="price">
            @if ($errors->has('price'))
                <div class="alert alert-danger">{{ $errors->first('price') }}</div>
            @endif
        </div>
        <div class="col-md-5">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image" >
            @if ($errors->has('image'))
                <div class="alert alert-danger">{{ $errors->first('image') }}</div>
            @endif
        </div>
        <input type="hidden" class="form-control" id="base64ImageInput" name="image_thumbnail">


        <div class="col-md-5">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="1" >Active</option>
                <option value="0" >Inactive</option>
            </select>
        </div>
        <div class="col-md-12">
            <label for="caption" class="form-label">caption</label>
            <textarea class="form-control" placeholder="Leave a comment here" id="caption" name="caption" style="height: 100px;"></textarea>
            @if ($errors->has('caption'))
                <div class="alert alert-danger">{{ $errors->first('caption') }}</div>
            @endif
        </div>

        <div class="col-12">
            <button class="btn btn-primary" type="submit">Submit form</button>
        </div>
    </form>
@endsection

@section('scripts')
    <script src="{{ asset('js/img2base64.js') }}"></script>
    <script>
        document.getElementById('image').addEventListener('change', function(event) {
            const file = event.target.files[0];
            console.log(file)
            if (file) {
                imgToBase64(file, function(base64Image) {
                    document.getElementById('base64ImageInput').value = base64Image;
                });
            }
        });
    </script>
@endsection
