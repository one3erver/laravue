<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Home',
            'name' => 'صفحه اصلی',
            'body' => 'یک محیط برنامه نویسی PHP ساده و هوشمند را که به هدف افزایش بهره وری توسعه دهنده ها تمرکز یافته و عمیقاً کدهای شما را درک می کند ایجاد کرده و امکان تکمیل کدها را به صورت هوشمندانه فراهم می کند، مراجعه سریع و بررسی خطاها به صورت بی درنگ از ویژگی های این نرم افزار است که همیشه برای کمک به شما در شکل دهی کدها، اجرای واحد تست و یا اشکال زدایی شهودی آماده است. این نرم افزار حاوی تمامی توابع WebStorm (HTML/CSS Editor, jаvascript Editor) بوده و پشتیبانی همه جانبه را برای PHP اضافه می کند.',
            'image' => 'https://picsum.photos/1200/250'
        ];

        $products = [
            [
                'name' => 'product 1',
                'description' => ' شکل دهی کدها، اجرای واحد تست و یا اشکال زدایی شهودی آماده است. این نرم افزار حاوی تمامی تواب',
                'image' => 'https://picsum.photos/150/150'
            ],
            [
                'name' => 'product 2',
                'description' => ' شکل دهی کدها، اجرای واحد تست و یا اشکال زدایی شهودی آماده است. این نرم افزار حاوی تمامی تواب',
                'image' => 'https://picsum.photos/150/150'
            ],
            [
                'name' => 'product 3',
                'description' => ' شکل دهی کدها، اجرای واحد تست و یا اشکال زدایی شهودی آماده است. این نرم افزار حاوی تمامی تواب',
                'image' => 'https://picsum.photos/150/150'
            ],
            [
                'name' => 'product 4',
                'description' => ' شکل دهی کدها، اجرای واحد تست و یا اشکال زدایی شهودی آماده است. این نرم افزار حاوی تمامی تواب',
                'image' => 'https://picsum.photos/150/150'
            ],
            [
                'name' => 'product 5',
                'description' => ' شکل دهی کدها، اجرای واحد تست و یا اشکال زدایی شهودی آماده است. این نرم افزار حاوی تمامی تواب',
                'image' => 'https://picsum.photos/150/150'
            ],
        ];

        return Inertia::render('laravue/Pages/Home', [
        'data' => $data,
         'products' => $products
    ]);

    }
}
