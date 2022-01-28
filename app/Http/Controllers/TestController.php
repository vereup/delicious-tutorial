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



class TestController extends Controller
{
    
    public function getTestDatas(Request $request){

        $id = Auth::id();
        $user = Auth::user();
        $stores = Store::get();
        $images = Image::get();
        
        $tabIndex = $request->tabIndex;

    

        dump($tabIndex);

            $userReviews = Review::where('user_id', $id)->paginate(2);
            
            $userWishes = Wish::where('user_id', $id)->paginate(2);

            return view('test', [
                'id' => $id,
                'user' => $user,
                'stores' => $stores,
                'images' => $images,
                // 'tab' => request('tab'),
                'userReviews' => $userReviews,
                'userWishes' => $userWishes,
                'request' => $request,
                'tabIndex' => $tabIndex
            ]);
        }

}