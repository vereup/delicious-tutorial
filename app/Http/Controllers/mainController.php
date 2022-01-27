<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Store;
use App\Models\Image;
use App\Models\Wish;


class MainController extends Controller
{
    public function getMainDatas(Request $request){

        
        $user_id = Auth::id();
        $categories = Category::get();
        $stores = Store::get();
        $images = Image::get();
        $wishes = Wish::get();
        $userWishes = Wish::where('user_id', $user_id);


        return view('master', [
            'categories' => $categories,
            'stores' => $stores,
            'images' => $images,
            'wishes' => $wishes,
            'user_id' => $user_id,
            'userWishes' => $userWishes
        ]);

    }
}
