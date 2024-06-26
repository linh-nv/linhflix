<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryAPI extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::orderBy('id', 'desc')->paginate(20);
        return $category;
    }

    /*
    * Search
    */
    public function store(Request $request){
        if(!empty($request)){
            $category = Category::where($request->all())->orderBy('id', 'desc')->get();
            if(count($category) > 0){
                return count($category) > 20 ? Category::where($request->all())->orderBy('id', 'desc')->paginate(20) : $category;
            }else{
                $data = [
                    'status: ' => 'false',
                    'message: ' => 'Không tìm thấy!!'
                ];
                return response($data, Response::HTTP_NOT_FOUND);
            }
        }else{
            $category = Category::orderBy('id', 'desc')->paginate(20);
            return $category;
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
                            
                // Kiểm tra xem yêu cầu đã tồn tại trong bất kỳ Category nào chưa
                $existingCategory = Category::where('slug', $request->slug)->first();
                
                if ($existingCategory) {
                    // Trả về phản hồi báo lỗi danh mục đã tồn tại
                    $data = [
                        'status: ' => 'false',
                        'message: ' => 'Không thể thêm, dữ liệu đã tồn tại!!'
                    ];
                    return response($data, Response::HTTP_CONFLICT);
                } else {
                    // Nếu danh mục không tồn tại, thêm danh mục mới và trả về phản hồi thành công với status code 201
                    $newCategory = new Category();
                    $newCategory->slug = $request->slug;
                    $newCategory->title = $request->title;
                    $newCategory->description = $request->description;
                    $newCategory->status = $request->status;
                    $newCategory->position = $request->position;
                    $newCategory->save();

                    return response($newCategory, Response::HTTP_CREATED);
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
            $category = Category::orderBy('id', 'desc')->paginate(20);

            return $category;
            // return $request;
            
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::where('id', $id)->first();

        if(!empty($category)){
            return $category;
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
                    $category = Category::where('slug', $request->slug)->first();
                    if(empty($category)){
                        Category::where('id', $id)->update($request->all());
                        return Category::where('id', $id)->first();
                    }else{
                        $data = [
                            'status: ' => 'false',
                            'message: ' => 'Không thể thêm, dữ liệu đã tồn tại!!'
                        ];
                        return response($data, Response::HTTP_CONFLICT);
                    }
                }else{
                    Category::where('id', $id)->update($request->all());
                    return Category::where('id', $id)->first();
                }
            }else{
                return Category::where('id', $id)->first();
            }
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::where('id', $id)->first();

        if(!empty($category)){
            $category->delete();
            return Category::orderBy('id', 'desc')->paginate(20);
        }else{
            $data = [
                'status: ' => 'false',
                'message: ' => 'Không tìm thấy dữ liệu!!'
            ];
            return response($data, Response::HTTP_NOT_FOUND);
        }
    }
}
