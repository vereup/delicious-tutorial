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
        $keyword = null;

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
                'tabIndex' => $tabIndex,
                'keyword' => $keyword
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
            
            if ($review->id != $request->deleteReviewId) {
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
    


