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

    <form class="row g-3" method="get" action="{{route('admin.settings.edit',$setting)}}">
        <div class="col-md-5">
            <label for="telegram_id" class="form-label">Telegram_Id</label>
            <input type="text" class="form-control" id="telegram_id" name="telegram_id" required value="{{$setting->telegram_id}}" disabled>
        </div>
        @csrf
        <div class="col-md-5">
            <label for="telegram_token" class="form-label">Telegram_Token</label>
            <input type="text" class="form-control" id="telegram_token" name="telegram_token"  required value="{{$setting->telegram_token}}" disabled>
        </div>
        <div class="col-md-5">
            <label for="site_title" class="form-label">Site_Title</label>
            <input type="text" class="form-control" id="site_title" name="site_title" required value="{{$setting->site_title}}" disabled>
        </div>
        <div class="col-md-5">
            <label for="logo" class="form-label">Logo</label>
            <input type="text" class="form-control" id="logo" name="logo" required value="{{$setting->logo}}" disabled>
        </div>
        <div class="col-md-12">
            <label for="landing_content" class="form-label">Landing_Content</label>
            <textarea class="form-control" placeholder="Leave a comment here" id="landing_content" name="landing_content" style="height: 100px;" required disabled> value="{{$setting->landing_content}}"</textarea>
        </div>
        <div class="col-12">
            <button class="btn btn-primary" type="submit">update setting</button>
        </div>
    </form>
@endsection