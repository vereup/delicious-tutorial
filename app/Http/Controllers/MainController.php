<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Store;
use App\Models\Image;
use App\Models\Wish;


class MainController extends Controller
{

    public function getMainDatas(Request $request){

        $user_id = Auth::id();
        $categories = Category::get();
        $images = Image::get();
        $wishes = Wish::get();
        $userWishes = Wish::where('user_id', $user_id)->get();
        $ratingList = $request->ratingList;
        $storeCounts = 0;

        $query = Store::select();

        // // 검색어입력
        if($request->keyword != null){
            $query = Store::where('name', 'like', "%{$request->keyword}%");
            $keyword = $request->keyword;
        }

        else{
            $keyword = null;
        }

        // 카테고리선택
        
        if($request->categoryList != null ){
            $categoryList = explode(',', $request->categoryList);
            $query->whereIn('category_id', $categoryList);
        }

        else{
            $categoryList = 'all';
        }
        
        $min = null;
        $max = null;

        // 평점선택 min 이상
        if($request->ratingList != null ){
            $ratingList = explode(',', $request->ratingList);

            if(count($ratingList) > 1){
                $min = min($ratingList);
                $max = max($ratingList);

            }

            else{
                $min = $ratingList[0];
                $max = 5.1;
            }
            
            $query->whereBetween('rating_average', [$min,$max]);

        }
        else{
            $ratingList = 'all';
        }

        $stores = $query->get();
        $storeCounts = $stores->count();
        $userWishCount = $userWishes->count();


        return view('master', [
            'user_id' => $user_id,
            'categories' => $categories,
            'stores' => $stores,
            'categoryList' => $categoryList,
            'ratingList' => $ratingList,
            'images' => $images,
            'wishes' => $wishes,
            'userWishes' => $userWishes,
            'storeCounts' => $storeCounts,
            'userWishCount' => $userWishCount,
            'keyword' => $keyword,
            'max' => $max,
            'min' => $min
            
        ]);
    }    
    

    public function removeWish(Request $request){

        $user_id = Auth::id();

        try {
            // $request->validate([
            //     'reviewId' => 'bail',
            //     'reviewTitle' => 'bali',
            //     'reviewContents' => 'bali',
            // ]);
            
            DB::beginTransaction();
            
            $wish = Wish::where('store_id', $request->storeId);
            
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


    public function addWish(Request $request){

        $user_id = Auth::id();

        $store_id = $request->storeId;
        


        try {
            // $request->validate([
            //     'reviewId' => 'bail',
            //     'reviewTitle' => 'bali',
            //     'reviewContents' => 'bali',
            // ]);
            
            DB::beginTransaction();
            
            $wish = Wish::insert(
                ['user_id' => $user_id, 'store_id' => $request->storeId]);
            
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
