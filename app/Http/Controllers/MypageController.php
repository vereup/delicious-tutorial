<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Review;
use App\Models\Store;
use App\Models\Image;
use App\Models\User;
use App\Models\Wish;



class MypageController extends Controller
{
    public function getMypageDatas(Request $request){

        $reviews = Review::get();
        $stores = Store::get();
        $images = Image::get();
        $users = User::get();
        $wishes = Wish::get();

        $loginEmail = 'kt@kt.com';

        $userReviews = array();
        $userWishes = array();

        foreach ($users as $user) {
          if($user->email == $loginEmail){
            $loginUser = $user;
          }
        }

        foreach ($reviews as $review){
          if($review->user_id == $loginUser->id){
            array_push($userReviews, $review);
          }
        }

        foreach ($wishes as $wish){
          if($wish->user_id == $loginUser->id){
            
            array_push($userWishes, $wish);
          }
        }



        return view('mypage', [
            'reviews' => $reviews,
            'stores' => $stores,
            'images' => $images,
            'users' => $users,
            'wishes' => $wishes,
            'loginEmail' => $loginEmail,
            'loginUser' => $loginUser,
            'userReviews' => $userReviews,
            'userWishes' => $userWishes
        ]);

    }
}
