<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Store;
use App\Models\Image;
use App\Models\Review;
use App\Models\User;
use App\Models\Wish;


class DetailController extends Controller
{
    public function getStoreDatas(Request $request){

        $loginUser = Auth::user();
        $user_id = Auth::id();
        $store = Store::find($request->storeId);


        // ???? 질문 ????????
        // $userWish = Wish::where('store_id', $request->storeId)->where('user_id',Auth::id())->exists();
        // $userReviews = Review::where('store_id', $request->storeId)->where('user_id', $user_id)->get();
        // $noUserReviews = Review::where('store_id', $request->storeId)->where('user_id', '!=', $user_id)->paginate(2);
        $query = Review::where('store_id', $request->storeId);
        
        if(Auth::user()) {
            $query->where('user_id', '!=', $user_id);
        }
        $reviews = $query->paginate(2);

        // $reviewCount = $userReviews->count();
        
        // $firstImagePath = ($storeImages->first())->path;
        // $storeCategory = Category::find($store->category_id);
        // $storeImages = Image::where('store_id', $request->storeId)->get();
        // $userReviews = Auth::user()->reviews()->get();
        // $storeReviews = Review::where('store_id', $request->storeId)->get();
        // $noUserReviews = $storeReviews->diff($userReviews)->paginate(2);

        return view('detail', [
            'store' => $store,
            'reviews' => $reviews,
            // 'userReviews' => $userReviews,
            'loginUser' => $loginUser
            // 'reviewCount' => $reviewCount,
            // 'userWish' => $userWish
            // 'noUserReviews' => $noUserReviews
            
            // 'firstImagePath' => $firstImagePath,
            // 'storeCategory' => $storeCategory, 
            // 'storeImages' => $storeImages,
            // 'storeReviews' => $storeReviews,
        ]);

    }


    

    public function writeReview(Request $request){

        $user_id = Auth::id();
        $storeId = $request->storeId;
        

        try {

            $request->validate([
                'title' => 'bail|required|between:5,30',
                'contents' => 'bail|required|between:20,300',
                'reviewDate' => 'bail|required|date',
            ]);
            
            
            DB::beginTransaction();
            
            $store = Store::find($request->storeId);
            
            
            if ($store->id !== intval($request->storeId)) {
                Session::flash('error', '올바르지않은 접근방법입니다.');
                return redirect()->back();
            }
            
            Review::insert(['user_id' =>$user_id, 'store_id' => $request->storeId, 'title' => $request->title, 
            'contents' => $request->contents, 'been_date' => $request->reviewDate, 'rating' => $request->rating]);
            
            $store->increment('review_count');
            
            if($store->rating_average == 0.0){
                $store->rating_average = $request->rating;
            }

            else {

                $reviews = Review::where('store_id', $request->storeId)->get();

                $sum = 0;
                foreach($reviews as $review){
                    $sum = $sum + $review->rating;
                }
                $average = 0;
                $average = $sum / $reviews->count();
                $store->rating_average = $average;
                
            }

            $store->save();
            
            DB::commit();

            return redirect()->back()->with('success','리뷰가 추가되었습니다.');;
            
        } 
        catch (\Exception $exception) {
            DB::rollback();
            Session::flash('error', $exception->getMessage());
            throw $exception;
        }


    }



}
