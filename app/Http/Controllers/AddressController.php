<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\City;

class AddressController extends Controller
{

    public function selectCity(Request $request){

        $counties = City::find($request->cityId)->counties()->get();

        return $counties;

    }
    

    // public function findByAddress(Request $request){

    //     $filtered_stores = Store::select();

    //     // 카테고리 검색
    //     if($categoryId != null){
    //         $filtered_stores->where('category_id', $categoryId);
    //     }

    //     // 주소 검색
    //     if($countyId != null && $countyId != 'none'){
    //         $filtered_stores->where('county_id', $countyId);
    //     }

    //     else{
    //         if($cityId != null){
    //             $filteredCountiesId = City::find($cityId)->counties()->get()->pluck('id');
    //             $filtered_stores->whereIn('county_id', $filteredCountiesId);
    //         }
    //     }
    // }

}
