<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Store;
use App\Models\Image;
use App\Models\Review;
use App\Models\User;


class DetailController extends Controller
{
    public function getStoreDatas($storeId){


        $categories = Category::get();
        $stores = Store::get();
        $images = Image::get();
        $reviews = Review::get();
        $users= User::get();
        
        $store = $stores[$storeId];
        $user = $users[1];
        

        return view('detail', [
            'categories' => $categories,
            'store' => $store,
            'images' => $images,
            'reviews' => $reviews,
            'user' => $user
        ]);

    }
}
