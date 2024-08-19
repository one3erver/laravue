@extends('admin.layouts.master')
@section('main_title')
    @
    <div class="pagetitle">
        <h1>User_Update</h1>

        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                <li class="breadcrumb-item active">User_Update</li>

            </ol>
        </nav>
    </div>
@endsection
@section('main')
    <form class="row g-3" method="post" action="{{route('admin.users.update',$user)}}">
        @method('PUT')
        <div class="col-md-5">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}" required>
        </div>
        @csrf
        <div class="col-md-5">
            <label for="mobile" class="form-label">Mobile</label>
            <input type="number" class="form-control" id="mobile" name="mobile" value="{{$user->mobile}}" required >
        </div>
        <div class="col-md-5">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}" required>
        </div>

<div class="col-12">
            <button class="btn btn-primary" type="submit">Submit form</button>
        </div>
    </form>
@endsection
