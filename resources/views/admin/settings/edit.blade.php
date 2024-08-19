@extends('admin.layouts.master')
@section('main_title')
    <div class="pagetitle">
        <h1>setting</h1>

        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href={{url('/')}}>Home</a></li>
                <li class="breadcrumb-item active">setting</li>

            </ol>
        </nav>
    </div>
@endsection
@section('main')
    <form class="row g-3" method="post" enctype="multipart/form-data"
          action="{{route('admin.settings.update',$setting)}}">
        @method('PUT')
        <div class="col-md-5">
            <label for="telegram_id" class="form-label">Telegram_Id</label>
            <input type="text" class="form-control" id="telegram_id" name="telegram_id" required
                   value="{{$setting->telegram_id}}">
        </div>
        @csrf
        <div class="col-md-5">
            <label for="telegram_token" class="form-label">Telegram_Token</label>
            <input type="text" class="form-control" id="telegram_token" name="telegram_token" required
                   value="{{$setting->telegram_token}}">
        </div>
        <div class="col-md-5">
            <label for="site_title" class="form-label">Site_Title</label>
            <input type="text" class="form-control" id="site_title" name="site_title" required
                   value="{{$setting->site_title}}">
        </div>
        <div class="col-md-5">
            <label for="logo" class="form-label">Logo</label>
            <input type="file" class="form-control" id="logo" name="logo" value="{{$setting->logo}}">
        </div>
        <div class="col-md-12">
            <label for="landing_content" class="form-label">Landing_Content</label>
            <textarea class="form-control" placeholder="Leave a comment here" id="landing_content"
                      name="landing_content" style="height: 100px;"
                      required>value="{{$setting->landing_content}}"</textarea>
        </div>
        @php
            $wallets = config('wallets', []); // Get wallets or an empty array if not set
            $walletsString = implode("\n", (array) $wallets); // Convert array to a string with each wallet on a new line
        @endphp
        <div class="col-md-12">
            <label for="landing_content" class="form-label">Wallets</label>
            <textarea class="form-control"
                      placeholder="Leave a comment here"
                      id="wallets"
                      name="wallets[]"
                      style="height: 100px;" required
            >{{ $walletsString }}</textarea>
        </div>
        <div class="col-12">
            <button class="btn btn-primary" type="submit">Submit form</button>
        </div>
    </form>
@endsection
