<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Store;
use App\Models\Image;
use App\Models\Wish;
use App\Models\City;
use App\Models\County;


class AdminController extends Controller
{

    public function getAdminDatas(Request $request){


        $keyword = null;

        $filtered_stores = Store::where('name', $request->name)->where('category_id', $request->categoryId)->paginate(5);
        // $filtered_stores = Store::where('name', $request->name)->where('category_id', $request->categoryId)->where('address', $request->address)->paginate(5);

        $categories = Category::get();

        $cities = City::get();

        $counties = County::get();
        

        if($filtered_stores->count() > 0){
            
            $stores = $filtered_stores;
        }

        else{
            $stores = Store::paginate(5);

        }
                

        return view('admin', [

            'keyword' => $keyword,
            'stores' => $stores,
            'categories' => $categories,
            'cities' => $cities,
            'counties' => $counties

            

        ]);

    }

    public function registStores(Request $request){

        $keyword = null;
        
        $categories = DB::table('catogories')->select('name')->get();


        return view('registStore', [

            'keyword' => $keyword,
            'stores' => $categories
            

        ]);

    }

}
