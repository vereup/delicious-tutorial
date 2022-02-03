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
        $stores = Store::get();
        $images = Image::get();
        
        $tabIndex = $request->tabIndex;

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



    public function modifyReview(Request $request){

        
        try {

            // $request->validate([
            //     'reviewId' => 'bail',
            //     'reviewTitle' => 'bali',
            //     'reviewContents' => 'bali',
            // ]);
            
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
        
        // $title = $request->reviewTitle;
        // $contents = $request->reviewContents;
        // $id = $request->reviewId;

        // DB::table('reviews')->where('id',$id)->update(['title'=>$title]);
        


    }

    public function deleteReview(Request $request){


        dump($request->deleteReviewId);

        try {

            // $request->validate([
            //     'id' => 'bail',
            //     'title' => 'bali',
            //     'contents' => 'bali',
            // ]);
            
            DB::beginTransaction();
            
            $review = Review::find($request->deleteReviewId);
            
            if ($review->id != $request->reviewId) {
                return redirect()->back()->with('error','리뷰 아이디 확인필요');;
            }
            
            $review->delete();
            
            DB::commit();

            return redirect()->back()->with('success','리뷰가 삭제되었습니다.');;
            
        } 
        catch (\Exception $exception) {
            DB::rollback();
            Session::flash('error', $exception->getMessage());
            throw $exception;
        }
        
        // $title = $request->reviewTitle;
        // $contents = $request->reviewContents;
        // $id = $request->reviewId;

        // DB::table('reviews')->where('id',$id)->update(['title'=>$title]);
        
    }

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
        