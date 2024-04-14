<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'Contact',
            'name' => 'تماس با ما',
            'body' => 'یک محیط برنامه نویسی PHP ساده و هوشمند را که به هدف افزایش بهره وری توسعه دهنده ها تمرکز یافته و عمیقاً کدهای شما را درک می کند ایجاد کرده و امکان تکمیل کدها را به صورت هوشمندانه فراهم می کند، مراجعه سریع و بررسی خطاها به صورت بی درنگ از ویژگی های این نرم افزار است که همیشه برای کمک به شما در شکل دهی کدها، اجرای واحد تست و یا اشکال زدایی شهودی آماده است. این نرم افزار حاوی تمامی توابع WebStorm (HTML/CSS Editor, jаvascript Editor) بوده و پشتیبانی همه جانبه را برای PHP اضافه می کند.',
            'image' => 'https://picsum.photos/3000/250'
        ];
        return Inertia::render('laravue/Pages/Contact', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $request;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
