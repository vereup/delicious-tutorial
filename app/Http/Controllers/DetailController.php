<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Store;
use App\Models\Image;
use App\Models\Review;
use App\Models\User;


class DetailController extends Controller
{
    public function getStoreDatas(Request $request){

        
        $loginUser = Auth::user();
        $store = Store::find($request->storeId);
        $storeCategory = Category::find($store->category_id);
        $storeImages = Image::get()->where('store_id', $request->storeId);
        $storeReviews = Review::get()->where('store_id', $request->storeId);
        $userReviews = $storeReviews->where('user_id', $loginUser);
        $reviewCount = $userReviews->count();
        $firstImagePath = ($storeImages->first())->path;


        return view('detail', [
            'store' => $store,
            'storeCategory' => $storeCategory, 
            'storeImages' => $storeImages,
            'storeReviews' => $storeReviews,
            'userReviews' => $userReviews,
            'loginUser' => $loginUser,
            'reviewCount' => $reviewCount,
            'firstImagePath' => $firstImagePath
            
        ]);

    }
}
