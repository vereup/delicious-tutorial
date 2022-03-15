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
        $tabIndex = 'Review';
        
        if($request->has('tabIndex')){
            $tabIndex = $request->tabIndex;
        }
        $model = "\\App\\Models\\" . $tabIndex;
        $datas = $model::where('user_id', $id)->paginate(2);

            return view('mypage', [
                'id' => $id,
                'user' => $user,
                'datas' => $datas,
                'request' => $request,
                'tabIndex' => $tabIndex
            ]);
    }


    public function modifyReview(Request $request){

        $id = Auth::id();
        
        try {
            $request->validate([
                'reviewId' => 'bail|required|numeric|exists:reviews,id',
                'reviewTitle' => 'bail|required|between:5,30',
                'reviewContents' => 'bail|required|between:20,300',
            ]);
            
            DB::beginTransaction();
            $review = Review::find($request->reviewId);

            if ($review->user_id != $id) {
                return redirect()->back()->with('error','사용자아이디와 리뷰 확인필요');;
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
                'deleteReviewId' => 'bail|required|numeric|exists:reviews,id',
            ]);
            
            DB::beginTransaction();
            $review = Review::find($request->deleteReviewId);
            
            if ($review->user_id != Auth::id()) {
                return redirect()->back()->with('error','사용자아이디와 리뷰 아이디 확인필요');;
            }
            $review->store->decrement('review_count');
            $store = $review->store;
            $review->delete();
            $reviews = Review::where('store_id', $store->id)->get();

            if($store->review_count == 0){
                $store->rating_average = 0.0;
            }
            
            else {
                $store->rating_average = $reviews->avg('rating');
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
                'deleteWishId' => 'bail|required|numeric|exists:wishes,id',
            ]);
            
            DB::beginTransaction();
            
            $wish = Wish::find($request->deleteWishId);
            
            if ($wish->id != $request->deleteWishId) {
                return redirect()->back()->with('error','찜 아이디 확인필요');
            }
            
            $wish->delete();
            DB::commit();
            return redirect()->back()->with('success','찜이 삭제되었습니다.');
            
        } 
        catch (\Exception $exception) {
            DB::rollback();
            Session::flash('error', $exception->getMessage());
            throw $exception;
        }
        
        
    }

}
    


