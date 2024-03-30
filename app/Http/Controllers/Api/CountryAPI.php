<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CountryAPI extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $country = Country::orderBy('id', 'desc')->paginate(20);
        return $country;
    }

    /*
    * Search
    */
    public function store(Request $request){
        if(!empty($request)){
            $country = Country::where($request->all())->orderBy('id', 'desc')->get();
            if(count($country) > 0){
                return count($country) > 20 ? Country::where($request->all())->orderBy('id', 'desc')->paginate(20) : $country;
            }else{
                $data = [
                    'status: ' => 'false',
                    'message: ' => 'Không tìm thấy!!'
                ];
                return response($data, Response::HTTP_NOT_FOUND);
            }
        }else{
            $country = Country::orderBy('id', 'desc')->paginate(20);
            return $country;
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create(Request $request)
    {
        // nếu có request dữ liệu
        if(!empty($request)){

            if (!$request->filled('id')) {
                            
                // Kiểm tra xem yêu cầu đã tồn tại trong bất kỳ Country nào chưa
                $existingCountry = Country::where('slug', $request->slug)->first();
                
                if ($existingCountry) {
                    // Trả về phản hồi báo lỗi danh mục đã tồn tại
                    $data = [
                        'status: ' => 'false',
                        'message: ' => 'Không thể thêm, dữ liệu đã tồn tại!!'
                    ];
                    return response($data, Response::HTTP_CONFLICT);
                } else {
                    // Nếu danh mục không tồn tại, thêm danh mục mới và trả về phản hồi thành công với status code 201
                    $newCountry = new Country();
                    $newCountry->slug = $request->slug;
                    $newCountry->title = $request->title;
                    $newCountry->description = $request->description;
                    $newCountry->status = $request->status;
                    $newCountry->save();

                    return response($newCountry, Response::HTTP_CREATED);
                }
            }else{
                $data = [
                    'status: ' => 'false',
                    'message: ' => 'Không nhập id!!'
                ];
                return response($data, Response::HTTP_BAD_REQUEST);
            }
        }
        // nếu request không có dữ liệu
        else{
            $country = Country::orderBy('id', 'desc')->paginate(20);

            return $country;
            // return $request;
            
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $country = Country::where('id', $id)->first();

        if(!empty($country)){
            return $country;
        }else{
            $data = [
                'status: ' => 'false',
                'message: ' => 'Không tìm thấy dữ liệu!!'
            ];
            return response($data, Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if($request->filled('id')){
            $data = [
                'status: ' => 'false',
                'message: ' => 'Không sửa id!!'
            ];
            return response($data, Response::HTTP_BAD_REQUEST);
        }else{
            if (!empty($request->all())){
                if ($request->filled('slug')) {
                    $country = Country::where('slug', $request->slug)->first();
                    if(empty($country)){
                        Country::where('id', $id)->update($request->all());
                        return Country::where('id', $id)->first();
                    }else{
                        $data = [
                            'status: ' => 'false',
                            'message: ' => 'Không thể thêm, dữ liệu đã tồn tại!!'
                        ];
                        return response($data, Response::HTTP_CONFLICT);
                    }
                }else{
                    Country::where('id', $id)->update($request->all());
                    return Country::where('id', $id)->first();
                }
            }else{
                return Country::where('id', $id)->first();
            }
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $country = Country::where('id', $id)->first();

        if(!empty($country)){
            $country->delete();
            return Country::orderBy('id', 'desc')->paginate(20);
        }else{
            $data = [
                'status: ' => 'false',
                'message: ' => 'Không tìm thấy dữ liệu!!'
            ];
            return response($data, Response::HTTP_NOT_FOUND);
        }
    }
}
