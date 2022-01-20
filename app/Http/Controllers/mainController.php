<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Store;


class mainController extends Controller
{
    public function getMainDatas(Request $request){

        $categories = Category::get();
        $stores = Store::get();

        return view('master', [
            'categories' => $categories,
            'stores' => $stores
        ]);

    }
}