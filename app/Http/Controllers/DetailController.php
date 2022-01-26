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

        $store = Store::find($storeId);
        

        $loginUser = $users[3];

        $userReviews = array();
        foreach ($reviews as $review) {
            if($review->store_id == $storeId && $review->user_id == $loginUser->id){
                array_push($userReviews, $review);
            }
        }
        
        $hasReview = 0;
        foreach ($reviews as $review) {
            if($review->store_id == $storeId && $review->user_id == $loginUser->id){
                $hasReview = 1;
            }
        }

        $i=0;
        foreach ($images as $image){
            if($image->store_id == $storeId && $i == 0){
                $firstImagePath = $image->path;
                $i=1;
            }            
        }


        $reviewCount = count($userReviews);


        return view('detail', [
            'categories' => $categories,
            'store' => $store,
            'storeId' => $storeId,
            'images' => $images,
            'firstImagePath' => $firstImagePath,
            'reviews' => $reviews,
            // 'userReviews' => $userReviews,
            'loginUser' => $loginUser,
            'reviewCount' => $reviewCount
        ]);

    }
}
