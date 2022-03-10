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
    
}
