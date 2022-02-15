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
        $userWish = Wish::where('store_id', $request->storeId)->where('user_id',Auth::id())->exists();
        $userReviews = Review::where('store_id', $request->storeId)->where('user_id', $user_id)->get();
        $noUserReviews = Review::where('store_id', $request->storeId)->where('user_id', '!=', $user_id)->paginate(2);
        
        $reviewCount = $userReviews->count();
        $keyword = null;
        
        // $firstImagePath = ($storeImages->first())->path;
        // $storeCategory = Category::find($store->category_id);
        // $storeImages = Image::where('store_id', $request->storeId)->get();
        // $userReviews = Auth::user()->reviews()->get();
        // $storeReviews = Review::where('store_id', $request->storeId)->get();
        // $noUserReviews = $storeReviews->diff($userReviews)->paginate(2);

        return view('detail', [
            'store' => $store,
            'userReviews' => $userReviews,
            'loginUser' => $loginUser,
            'reviewCount' => $reviewCount,
            'keyword' => $keyword,
            'userWish' => $userWish,
            'noUserReviews' => $noUserReviews
            
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
                'title' => 'bail|string|required|between:10,60',
                'contents' => 'bail|required|string|between:40,600',
                'reviewDate' => 'bail|required|date',
            ]);
            
            DB::beginTransaction();
            
            $review = Review::insert(['user_id' =>$user_id, 'store_id' => $request->storeId, 'title' => $request->title, 
            'contents' => $request->contents, 'been_date' => $request->reviewDate, 'rating' => $request->rating]);

                        
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
