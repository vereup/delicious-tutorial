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
use App\Models\City;
use App\Models\County;
use App\Models\LocalCode;
use Illuminate\Support\Facades\Storage;


class AdminController extends Controller
{

    public function getAdminDatas(Request $request){


        $storeNameKeyword = $request->storeName;
        $storeTelephoneNumber = $request->storeTelephoneNumber;
        $categoryId = $request->adminCategory;
        $cityId = $request->adminCity;
        $countyId = $request->adminCounty;

        $filtered_stores = Store::select();

        // 키워드 검색
        if($storeNameKeyword != null){
            $filtered_stores = Store::where('name', 'like', "%{$storeNameKeyword}%");
        }
        elseif($storeTelephoneNumber != null){
            $filtered_stores = Store::where('telephone_number', 'like', "%{$storeTelephoneNumber}%");
        }

        // 카테고리 검색
        if($categoryId != null){
            $filtered_stores->where('category_id', $categoryId);
        }

        // 주소 검색
        if($countyId != null && $countyId != 'none'){
            $filtered_stores->where('county_id', $countyId);
        }

        else{
            if($cityId != null){
                $filteredCountiesId = City::find($cityId)->counties()->get()->pluck('id');
                $filtered_stores->whereIn('county_id', $filteredCountiesId);
            }
        }

        $filtered_stores = $filtered_stores->paginate(5);
        $stores = $filtered_stores;
        $categories = Category::get();
        $cities = City::with(['counties'])->get();
        $counties = County::get();
        
        return view('admin/admin', [
            'stores' => $stores,
            'categories' => $categories,
            'cities' => $cities,
            'counties' => $counties
        ]);

    }


    public function getRegistDatas(Request $request){

        $categories = Category::get();
        $cities = City::with(['counties'])->get();
        $counties = County::get();
        $localCodes = LocalCode::get();        

        return view('admin/registStore', [
            'categories' => $categories,
            'cities' => $cities,
            'counties' => $counties,
            'localCodes' => $localCodes
        ]);

    }


    public function registStores(Request $request){


        try {
        
            $request->validate([
                'storeName' => 'bail|required|between:1,30',
                'storeIntro' => 'bail|required|between:10,300',
                'category_id' => 'bail|required|',
                'adminCity' => 'bail|required|',
                'adminCounty' => 'bail|required|',
                'addressDetail' => 'bail|required|',
                'localCode' => 'bail|required|',
                'middleNumber' => 'bail|required|',
                'lastNumber' => 'bail|required|',
                'category_id' => 'bail|required|',
            ]);


            // 이미지 파일 유효성검사 ??
            // for($i=1;$i<=5;$i++){
            //     if($request->hasFile('inputFile'.$i)){
            //         $request->validate([
            //             'inputFile'.$i => 'file|mimes:jpeg, jpg, bmp, png',
            //         ]);
            //     }
            // }

                    
            DB::beginTransaction();
            
            $telephoneNumber = $request->middleNumber.$request->lastNumber;
            
            $storeId = Store::insertGetId(['name' => $request->storeName, 'introduction' => $request->storeIntro, 'category_id' => $request->category_id, 'address_detail' => $request->addressDetail,
            'county_id' => $request->adminCounty, 'local_code_id' => $request->localCode, 'telephone_number' => $telephoneNumber, 'rating_average' => 0.0, 'review_count' => 0]);

            // 이미지등록
            $input = $request->all();
            for($i=1;$i<=5;$i++){
                if($request->hasFile('inputFile'.$i)){
                    $destination_path = 'public/images';
                    $image = $request->file('inputFile'.$i);
                    $image_name = 'store_Img_'.$storeId.'-'.$i.'.'.$image->extension();
                    $request->file('inputFile'.$i)->storeAs($destination_path, $image_name);
                    $path = '/storage/images/'.$image_name;
                    Image::insert(['path' => $path, 'store_id' => $storeId]);
                    $input['inputFile'.$i] = $image_name;
                }
            }
    
            DB::commit();
            
            return redirect()->back()->with('success','맛집이 추가되었습니다.');;
            
        } 
        catch (\Exception $exception) {
            DB::rollback();
            Session::flash('error', $exception->getMessage());
            throw $exception;
        }
    }


    
    public function getModifyStoresDatas(Request $request){

        $store = Store::with(['images','category','county','localCode'])->find($request->storeId);
        $middleNumber = substr($store->telephone_number,0,-4);
        $lastNumber = substr($store->telephone_number, -4);
        $categories = Category::get();
        $cities = City::get();
        $city = $store->county->city->id;
        $counties = County::get();
        $localCodes = LocalCode::get();
        $store->get();

        // 이미지 이름 추출
        $imageNames = array(0 => "", 1 => "", 2 => "", 3 => "", 4 => "");
        foreach($store->images as $image){
            $name = str_replace('/storage/images/','',$image->path);

            switch(true){
                case (strpos($name, '-1')):
                    $imageNames[0] = $name;
                    break;
                case (strpos($name, '-2')):
                    $imageNames[1] = $name;
                    break;
                case (strpos($name, '-3')):
                    $imageNames[2] = $name;
                    break;
                case (strpos($name, '-4')):
                    $imageNames[3] = $name;
                    break;
                case (strpos($name, '-5')):
                    $imageNames[4] = $name;
                    break;
            }
        }
        

        return view('admin/modifyStore', [

            'store' => $store,
            'categories' => $categories,
            'cities' => $cities,
            'city' => $city,
            'counties' => $counties,
            'localCodes' => $localCodes,
            'middleNumber' => $middleNumber,
            'lastNumber' => $lastNumber,
            'images' => $store->images,
            'imageNames' => $imageNames
    ]);
    }

    public function modifyStores(Request $request){

        
        try {
            
            $request->validate([
                'storeName' => 'bail|required|between:1,30',
                'storeIntro' => 'bail|required|between:10,300',
                'category_id' => 'bail|required|',
                'adminCity' => 'bail|required|',
                'adminCounty' => 'bail|required|',
                'addressDetail' => 'bail|required|',
                'localCode' => 'bail|required|',
                'middleNumber' => 'bail|required|',
                'lastNumber' => 'bail|required|',
                'category_id' => 'bail|required|',
            ]);
            
            
            DB::beginTransaction();

            $store = Store::with(['images','category','county','localCode'])->find($request->storeId);
            $storeId = $request->storeId;
            $telephoneNumber = $request->middleNumber.$request->lastNumber;

            Store::find($storeId)->update(['name' => $request->storeName, 'introduction' => $request->storeIntro, 'category_id' => $request->category_id, 'address_detail' => $request->addressDetail,
            'county_id' => $request->adminCounty, 'local_code_id' => $request->localCode, 'telephone_number' => $telephoneNumber]);

            // 이미지 이름 추출
            $imageNames = array(0 => "", 1 => "", 2 => "", 3 => "", 4 => "");
            foreach($store->images as $image){
                $name = str_replace('/storage/images/','',$image->path);

                switch(true){
                    case (strpos($name, '-1')):
                        $imageNames[0] = $name;
                        break;
                    case (strpos($name, '-2')):
                        $imageNames[1] = $name;
                        break;
                    case (strpos($name, '-3')):
                        $imageNames[2] = $name;
                        break;
                    case (strpos($name, '-4')):
                        $imageNames[3] = $name;
                        break;
                    case (strpos($name, '-5')):
                        $imageNames[4] = $name;
                        break;
                }
            }

            // 이미지 삭제 및 등록
            $input = $request->all();

            // 수정할 이미지 삭제
            for($i=0;$i<5;$i++){
                $index = 'fileListCheck'.($i+1);
                $fileListCheck = $request->$index;
                if($request->hasFile('inputFile'.($i+1)) && $imageNames[$i] != '' || $fileListCheck == 'off' && $imageNames[$i] != ''){
                    Storage::disk('images')->delete(basename($imageNames[$i]));
                    $previous_path = '/storage/images/'.$imageNames[$i];
                    $previousImage = Image::where('path', $previous_path)->first();
                    $previousImage->delete();
                }
            }
            
            // 이미지등록
            for($i=0;$i<5;$i++){
                if($request->hasFile('inputFile'.($i+1))){
                    $destination_path = 'public/images';
                    $image = $request->file('inputFile'.($i+1));
                    $image_name = 'store_Img_'.$storeId.'-'.($i+1).'.'.$image->extension();
                    $request->file('inputFile'.($i+1))->storeAs($destination_path, $image_name);
                    $path = '/storage/images/'.$image_name;
                    Image::insert(['path' => $path, 'store_id' => $storeId]);
                    $input['inputFile'.($i+1)] = $image_name;
                }
            }
    
            DB::commit();
            
            return redirect()->back()->with('success','맛집이 수정되었습니다.');;
            
        } 
        catch (\Exception $exception) {
            DB::rollback();
            Session::flash('error', $exception->getMessage());
            throw $exception;
        }
    }


    public function deleteStore(Request $request){

        // //로그인된 사용자 확인
        // $user_id = Auth::id();
        // dd($user_id);
        // if($user_id != 1){
        //     return redirect()->route('home')->with('error','아이디를 확인하세요.');
        // }
        
        try {
            
            DB::beginTransaction();
            
            // 스토어 찾기
            $store = Store::find($request->id);
            
            // 이미지 삭제
            $imageNames = array();
            foreach($store->images as $image){
                $name = str_replace('/storage/images/','',$image->path);
                array_push($imageNames, $name);
            }
            $imageCount = count($imageNames);
            
            for($i=0;$i<$imageCount;$i++){
                Storage::disk('images')->delete(basename($imageNames[$i]));
            }
            
            // 이미지 DB삭제
            $image = Image::where('store_id', $request->id);
            $image->delete();
            
            // 스토어 삭제
            $store->delete();
            
            DB::commit();
            
            return redirect()->back()->with('success','스토어가 삭제되었습니다.');
        } 
        catch (\Exception $exception) {
            DB::rollback();
            Session::flash('error', $exception->getMessage());
            throw $exception;
        }
    }
}
