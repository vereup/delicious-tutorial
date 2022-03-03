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


        $keyword = null;

        $storeNameKeyword = $request->storeName;
        $storeTelephoneNumber = $request->storeTelephoneNumber;
        $categoryId = $request->adminCategory;
        $cityId = $request->adminCity;
        $countyId = $request->adminCounty;

        $filtered_stores = Store::select();

        if($storeNameKeyword != null){
            $filtered_stores = Store::where('name', 'like', "%{$storeNameKeyword}%");
        }
        elseif($storeTelephoneNumber != null){
            $filtered_stores = Store::where('telephone_number', 'like', "%{$storeTelephoneNumber}%");
        }
        // else{
        //     $filtered_stores = Store::select();
        // }

        // dump($storeNameKeyword);
        // dump($storeTelephoneNumber);
        // dump($categoryId);
        // dump($cityId);
        // dump($countyId);
        // dump($filtered_stores->count());

        if($categoryId != null){
            $filtered_stores->where('category_id', $categoryId);
        }
        if($countyId != null && $countyId != 'none'){
            $filtered_stores->where('county_id', $countyId);
        }


        // check!!!!!!!!!!!!!!!!!!
        else{
            if($cityId != null){
                $filteredCounties = City::find($cityId)->counties()->get();
                // dump($filtered_stores);
                foreach($filteredCounties as $filteredCounty){
                    // dump($filteredCounty->id);
                    $filtered_stores->where('county_id', $filteredCounty->id);
                }
            }
        }




        // elseif($countyId == null && $cityId != null){
            
        //     $filteredCounties = City::find($cityId)->counties()->get();
        //     $countiesIdList = $filteredCounties->pluck('county_id');
        //     dump($filteredCounties->count());
        //     dump($countiesIdList);
            
        //     if($countiesIdList->count() == 0){
        //         $filtered_stores->where('county_id', 999999);
        //     }

        //     elseif($countiesIdList->count() ==1){
        //         $filtered_stores->where('county_id', $countiesIdList->first());
        //     }
            
        // }

        // elseif($countyId == 'none' && $cityId != null){

        //         $filteredCounties = City::find($cityId)->counties()->get();
        //         $countiesIdList = $filteredCounties->pluck('county_id');
        //         dump($countiesIdList);
        //         $filtered_stores->whereIn('county_id', $countiesIdList);
        //         dump($filtered_stores->count());
        //     }


            // if($filteredCounties->count() == 0){
            //     $filtered_stores->where('county_id', 999999);
            // }
            // elseif($filteredCounties->count() == 1){
            //     $filtered_stores->where('county_id', $filteredCounties->first()->id);
            // }
            // else{
            //     $filtered_stores->whereIn('county_id', $filteredCounties);
            // }

        $filtered_stores = $filtered_stores->paginate(5);
        $stores = $filtered_stores;

        $categories = Category::get();
        $cities = City::with(['counties'])->get();
        $counties = County::get();
        

        return view('admin/admin', [

            'keyword' => $keyword,
            'stores' => $stores,
            'categories' => $categories,
            'cities' => $cities,
            'counties' => $counties

            

        ]);

    }




    public function getRegistDatas(Request $request){

        $keyword = null;
        
        $categories = Category::get();
        $cities = City::with(['counties'])->get();
        $counties = County::get();
        $localCodes = LocalCode::get();
        $file = $request->file('inputFile1');
        dump($file);

        return view('admin/registStore', [

            'keyword' => $keyword,
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
                // 'image' => 'file|mimes:jpeg, jpg, bmp, png',
            ]);
            
            // dd($request->storeIntro);
                    
            DB::beginTransaction();
            
            // if ($store->id !== intval($request->storeId)) {
                //     Session::flash('error', '올바르지않은 접근방법입니다.');
                //     return redirect()->back();
                // }
            
            $telephoneNumber = $request->middleNumber.$request->lastNumber;
            
            $storeId = Store::insertGetId(['name' => $request->storeName, 'introduction' => $request->storeIntro, 'category_id' => $request->category_id, 'address_detail' => $request->addressDetail,
            'county_id' => $request->adminCounty, 'local_code_id' => $request->localCode, 'telephone_number' => $telephoneNumber, 'rating_average' => 0.0, 'review_count' => 0]);

            // 이미지등록
            $input = $request->all();
            for($i=1;$i<=5;$i++){
                if($request->hasFile('inputFile'.$i)){
                    $destination_path = 'public/images';
                    $image = $request->file('inputFile'.$i);
                    // $image_name = $image->getClientOriginalName();
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


        $keyword = null;
        $store = Store::with(['images','category','county','localCode'])->find($request->storeId);
        $middleNumber = substr($store->telephone_number,0,-4);
        $lastNumber = substr($store->telephone_number, -4);
        $categories = Category::get();
        $cities = City::get();
        $city = $store->county->city->id;
        $counties = County::get();
        $localCodes = LocalCode::get();
        $store->get();

        $imageNames = array();
        foreach($store->images as $image){
            $name = str_replace('/storage/images/','',$image->path);
            array_push($imageNames, $name);
        }
        sort($imageNames);

        return view('admin/modifyStore', [

            'keyword' => $keyword,
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
            
            // $request->validate([
            //     'storeName' => 'bail|required|between:1,30',
            //     'storeIntro' => 'bail|required|between:10,300',
            //     'category_id' => 'bail|required|',
            //     'adminCity' => 'bail|required|',
            //     'adminCounty' => 'bail|required|',
            //     'addressDetail' => 'bail|required|',
            //     'localCode' => 'bail|required|',
            //     'middleNumber' => 'bail|required|',
            //     'lastNumber' => 'bail|required|',
            //     'category_id' => 'bail|required|',
            //     // 'image' => 'file|mimes:jpeg, jpg, bmp, png',
            // ]);
            
            
            DB::beginTransaction();
            
            // if ($store->id !== intval($request->storeId)) {
                //     Session::flash('error', '올바르지않은 접근방법입니다.');
                //     return redirect()->back();
                // }
                
                $store = Store::with(['images','category','county','localCode'])->find($request->storeId);
                $storeId = $request->storeId;
                $telephoneNumber = $request->middleNumber.$request->lastNumber;
                    
                Store::find($storeId)->update(['name' => $request->storeName, 'introduction' => $request->storeIntro, 'category_id' => $request->category_id, 'address_detail' => $request->addressDetail,
                'county_id' => $request->adminCounty, 'local_code_id' => $request->localCode, 'telephone_number' => $telephoneNumber]);


            // $imageNames = array();
            // foreach($store->images as $image){
            //     $name = str_replace('/storage/images/','',$image->path);
            //     array_push($imageNames, $name);
            // }
            
            $imageNames = array();
            foreach($store->images as $image){
                $name = str_replace('/storage/images/','',$image->path);
                array_push($imageNames, $name);
            }
            sort($imageNames);
            $imageCount = count($imageNames);

            // dd($imageCount);

            $input = $request->all();


            // 수정할 이미지 삭제
            for($i=1;$i<=$imageCount;$i++){
                if($request->hasFile('inputFile'.$i)){
                    Storage::disk('images')->delete(basename($imageNames[$i-1]));
                    $previous_path = '/storage/images/'.$imageNames[$i-1];
                    $previousImage = Image::where('path', $previous_path)->first();
                    $previousImage->delete();
                    // dd($previousImage);
                }
            }
            
            // 이미지등록
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

            // $imageCount = Store::find($request->storeId)->images()->count();
            
            // for($i=10;$i<=15;$i++){
            //     for($j=$imageCount;$j<=5;$j++){
            //         if($request->hasFile('inputFile'.$i)){
            //             $destination_path = 'public/images';
            //             $image = $request->file('inputFile'.$i);
            //             // $image_name = $image->getClientOriginalName();
            //             $image_name = 'store_Img_'.$storeId.'-'.$j.'.'.$image->extension();
            //             $request->file('inputFile'.$i)->storeAs($destination_path, $image_name);
            //             $path = '/storage/images/'.$image_name;
            //             Image::insert(['path' => $path, 'store_id' => $storeId]);
            //             $input['inputFile'.$i] = $image_name;
            //         }
            //     }
            // }

            

    
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

        $keyword = null;


        try {
            // $request->validate([
            //     'reviewId' => 'bail',
            //     'reviewTitle' => 'bali',
            //     'reviewContents' => 'bali',
            // ]);
            
            DB::beginTransaction();
            
            $store = Store::find($request->id);
            
            $store->delete();

            $image = Image::where('store_id', $request->id);

            $image->delete();
            
            DB::commit();

            return redirect()->back()->with('success','스토어가 삭제되었습니다.');;
            
        } 
        catch (\Exception $exception) {
            DB::rollback();
            Session::flash('error', $exception->getMessage());
            throw $exception;
        }
        
    }


}
