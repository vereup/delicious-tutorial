<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Review;
use App\Models\Store;
use App\Models\Image;
use App\Models\User;
use App\Models\Wish;



class MypageController extends Controller
{
    
    public function getMypageDatas(Request $request){

        $id = Auth::id();
        $user = Auth::user();
        $stores = Store::get();
        $images = Image::get();
        
        $tabIndex = $request->tabIndex;

        dump($request->reviewId);

        if ($tabIndex <= 1 || $tabIndex == null){

            $userReviewsCount = Review::where('user_id', $id)->count();
            $userReviews = Review::where('user_id', $id)->paginate(2);

            return view('mypage', [
                'id' => $id,
                'user' => $user,
                'stores' => $stores,
                'images' => $images,
                'userReviews' => $userReviews,
                'userReviewsCount' => $userReviewsCount,
                'request' => $request,
                'tabIndex' => $tabIndex
            ]);
        }
        else{
            $userWishesCount = Wish::where('user_id', $id)->count();
            $userWishes = Wish::where('user_id', $id)->paginate(2);
            return view('mypage', [
                'id' => $id,
                'user' => $user,
                'stores' => $stores,
                'images' => $images,
                'userWishes' => $userWishes,
                'userWishesCount' => $userWishesCount,
                'request' => $request,
                'tabIndex' => $tabIndex
            ]);
        }
        }

        // public function editReview(Request $request){

        //     $id = Auth::id();
        //     $user = Auth::user();
        //     $stores = Store::get();
        //     $images = Image::get();

        //     $userReviews = Review::where('user_id', $id)
            
        //     $title = $request->reviewTitle;
        //     $contetens = $request->reviewContents;
    
        //     if ($tabIndex <= 1 || $tabIndex == null){
    
        //         $userReviewsCount = Review::where('user_id', $id)->count();
        //         $userReviews = Review::where('user_id', $id)->paginate(2);
    
        //         return view('mypage', [
        //             'id' => $id,
        //             'user' => $user,
        //             'stores' => $stores,
        //             'images' => $images,
        //             'userReviews' => $userReviews,
        //             'userReviewsCount' => $userReviewsCount,
        //             'request' => $request,
        //             'tabIndex' => $tabIndex
        //         ]);
        //     }
        //     else{
        //         $userWishesCount = Wish::where('user_id', $id)->count();
        //         $userWishes = Wish::where('user_id', $id)->paginate(2);
        //         return view('mypage', [
        //             'id' => $id,
        //             'user' => $user,
        //             'stores' => $stores,
        //             'images' => $images,
        //             'userWishes' => $userWishes,
        //             'userWishesCount' => $userWishesCount,
        //             'request' => $request,
        //             'tabIndex' => $tabIndex
        //         ]);
        //     }
        //     }
    



}



        // if (request('tab') === 'review') {
        //     $userReviews = Review::where('user_id', $id)->paginate(2);
            
        //     return view('mypage', [
        //         'id' => $id,
        //         'user' => $user,
        //         'stores' => $stores,
        //         'images' => $images,
        //         'tab' => request('tab'),
        //         'userReviews' => $userReviews
        //     ]);
        // } 
        // else {
        //     $userWishes = Wish::where('user_id', $id)->paginate(2);

        //     return view('mypage', [
        //         'id' => $id,
        //         'user' => $user,
        //         'stores' => $stores,
        //         'images' => $images,
        //         'tab' => request('tab'),
        //         'userWishes' => $userWishes
        //     ]);
        // }
        
        
        // $userReviews = Review::get()->where('user_id', $id);
        // $userWishes = Wish::get()->where('user_id', $id);

        // $userReviewsCount = $userReviews->count();
        // $userWishesCount = $userWishes->count();
        
        
 

