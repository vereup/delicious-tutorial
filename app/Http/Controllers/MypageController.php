<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
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

        $id = Auth::id();
        $user = Auth::user();
        $keyword = null;
        
        $tabIndex = $request->tabIndex;

        if ($tabIndex <= 1 || $tabIndex == null){
            $userReviewsCount = Review::where('user_id', $id)->count();
            $userReviews = Review::where('user_id', $id)->paginate(2);
            
            return view('mypage', [
                'id' => $id,
                'user' => $user,
                'userReviews' => $userReviews,
                'userReviewsCount' => $userReviewsCount,
                'request' => $request,
                'tabIndex' => $tabIndex,
                'keyword' => $keyword
            ]);
        }
        
        else{
            $userWishesCount = Wish::where('user_id', $id)->count();
            $userWishes = Wish::where('user_id', $id)->paginate(2);

            

            
            // $query = Wish::where('user_id', $id)->where('store_id','!=','')->get();
            // $userWishStoreId = array();
            // foreach($query as $userWish){
            //     array_push($userWishStoreId, $userWish->store_id);
            // }
            // $images = Image::whereIn('store_id', $userWishStoreId)->get();
            // foreach($userWishStoreId as $eachId){
            // }


            // dd($images);


            // $images = Image::get();
            // foreach($images as $image){
            //     foreach($userWishes as $userWish){}
            //         if($image->store_id == $userWish->store_id){
                        
            //         }
            // }


            return view('mypage', [
                'id' => $id,
                'user' => $user,
                'userWishes' => $userWishes,
                'userWishesCount' => $userWishesCount,
                'request' => $request,
                'tabIndex' => $tabIndex,
                'keyword' => $keyword

            ]);
        }
    }



    public function modifyReview(Request $request){

        
        try {

            $request->validate([
                'reviewId' => 'bail',
                'reviewTitle' => 'bail',
                'reviewContents' => 'bail',
            ]);
            
            DB::beginTransaction();
            
            $review = Review::find($request->reviewId);
            
            if ($review->id != $request->reviewId) {
                return redirect()->back()->with('error','리뷰 아이디 확인필요');;
            }
            
            $review->title = $request->reviewTitle;
            $review->contents = $request->reviewContents;
            $review->save();
            
            DB::commit();

            return redirect()->back()->with('success','리뷰가 수정되었습니다.');;
            
        } 
        catch (\Exception $exception) {
            DB::rollback();
            Session::flash('error', $exception->getMessage());
            throw $exception;
        }
        


    }

    public function deleteReview(Request $request){


        dump($request->deleteReviewId);

        try {

            $request->validate([
                'deleteReviewId' => 'bail',
            ]);
            
            DB::beginTransaction();
            
            $review = Review::find($request->deleteReviewId);
            
            // if ($review->id != $request->deleteReviewId) {
                //     return redirect()->back()->with('error','리뷰 아이디 확인필요');;
                // }
                
                $review->store->decrement('review_count');
                
                $store = $review->store;
                
                $review->delete();
            // dd($review->store->id);
            
            $reviews = Review::where('store_id', $store->id)->get();


            if($store->review_count == 0){
                // $review->store->update(['rating_average' => 0.0]);
                $store->rating_average = 0.0;
            }
            
            else {
                // $storeId = $review->store->id;
                $sum = 0;
                foreach($reviews as $eachReview){
                    $sum = $sum + $eachReview->rating;
                }
                
                $average = 0;
                $average = $sum / $reviews->count();
                $store->rating_average = $average;
                // dd($review->store->rating_average);
                // $review->store->update(['rating_average' => $average]);

                // Store::find(5)->update(['rating_avarage' => $average]);
                // dd($sum);
                // dd($reviews->count());
                // dump($review->store->rating_average);
                // dump($average);

            }



            $store->save();


            
            DB::commit();

            return redirect()->back()->with('success','리뷰가 삭제되었습니다.');;
            
        } 
        catch (\Exception $exception) {
            DB::rollback();
            Session::flash('error', $exception->getMessage());
            throw $exception;
        }

    }


    public function deleteWish(Request $request){


        dump($request->deleteWishId);

        try {

            $request->validate([
                'deleteWishId' => 'bail',
            ]);
            
            DB::beginTransaction();
            
            $wish = Wish::find($request->deleteWishId);
            
            if ($wish->id != $request->deleteWishId) {
                return redirect()->back()->with('error','찜 아이디 확인필요');;
            }
            
            $wish->delete();
            
            DB::commit();

            return redirect()->back()->with('success','찜이 삭제되었습니다.');;
            
        } 
        catch (\Exception $exception) {
            DB::rollback();
            Session::flash('error', $exception->getMessage());
            throw $exception;
        }
        
        
    }

}
    


