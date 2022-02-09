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


class DetailController extends Controller
{
    public function getStoreDatas(Request $request){

        
        $loginUser = Auth::user();
        $user_id = Auth::id();
        $store = Store::find($request->storeId);
        $storeCategory = Category::find($store->category_id);
        $storeImages = Image::get()->where('store_id', $request->storeId);
        $storeReviews = Review::get()->where('store_id', $request->storeId);
        $userReviews = $storeReviews->where('user_id', $user_id);
        $noUserReviews = $storeReviews->diff($userReviews);
        $reviewCount = $userReviews->count();
        $firstImagePath = ($storeImages->first())->path;
        $keyword = null;



        return view('detail', [
            'store' => $store,
            'storeCategory' => $storeCategory, 
            'storeImages' => $storeImages,
            'storeReviews' => $storeReviews,
            'userReviews' => $userReviews,
            'loginUser' => $loginUser,
            'reviewCount' => $reviewCount,
            'firstImagePath' => $firstImagePath,
            'keyword' => $keyword,
            'noUserReviews' => $noUserReviews
            
        ]);

    }


    

    public function writeReview(Request $request){

        $user_id = Auth::id();
        $storeId = $request->storeId;
        

        try {

            $request->validate([
                'title' => 'bail',
                'contents' => 'bail',
                'reviewDate' => 'bail',
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


        dump($request->title);

        $contents = $request->get('contents');

        dump($contents);
    
        dump($request->reviewDate);
    

        // return back();
            
        

    }



}
