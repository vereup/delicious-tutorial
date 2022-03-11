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
        $ratingList = $request->ratingList;

        $query = Store::select();

        // // 검색어입력
        if(isset($request->keyword)){
            $query = Store::where('name', 'like', "%{$request->keyword}%");
            $keyword = $request->keyword;
        }

        // 카테고리선택
        
        if(isset($request->categoryList)){
            $categoryList = explode(',', $request->categoryList);
            $query->whereIn('category_id', $categoryList);
        }

        // 평점선택 min 이상
        if(isset($request->ratingList)){
            $ratingList = explode(',', $request->ratingList);
            $min = min($ratingList);
            if(count($ratingList) == 1){
                $max = 5;
            }
            else{
                $max = max($ratingList);
            }
            $query->whereBetween('rating_average', [$min,$max]);
        }

        $stores = $query->get();

        return view('master', [
            'user_id' => $user_id,
            'categories' => $categories,
            'stores' => $stores
        ]);
    }    
    

    public function removeWish(Request $request){

        $user_id = Auth::id();


        /// ??? 질문 ????
        // $request->merge([ 'storeId' => $request->route('id') ]);
        // $store_id = $request->storeId;


        try {
            $request->validate([
                'storeId' => 'bail|required|numeric|exists:stores,id',
            ]);
            
            DB::beginTransaction();
            
            $wish = Wish::where('store_id', $request->storeId)->where('user_id', $user_id)->first();
            
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
            $request->validate([
                'storeId' => 'bail|required|numeric|exists:stores,id',
            ]);
            
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
