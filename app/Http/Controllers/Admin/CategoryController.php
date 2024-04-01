<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Movie;
use App\Models\Movie_API;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Category::orderBy('position','ASC')->get();
        $movie = Movie::whereBetween('year',[1999,2001])->get();
        
        // cập nhật api vào flie
        // $api = [];
        // foreach ($movie as $m) {
        //     $api[$m->id] = Movie_API::createFromApi($m->slug);
        // }
        
        // $path = public_path()."/json_file/";
        // if(!is_dir($path)){
        //     mkdir($path,0777,true);
        // }
        // $jsonString = json_encode($api);
        
        // file_put_contents($path . 'api.json', $jsonString );
        
        // $pathh = public_path("/json_file/temp.json");
        // $jsonData = file_get_contents($pathh);
        // $data = json_decode($jsonData, true);

        return view('admin.category.index',compact('list'));
        // return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request -> all();
        $category = new Category();
        $category->title = $data['title'];
        $category->slug = $data['slug'];
        $category->description = $data['description'];
        $category->status = $data['status'];

        $category->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::find($id);

        return view('admin.category.form',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request -> all();
        $category = Category::find($id);
        $category->title = $data['title'];
        $category->slug = $data['slug'];
        $category->description = $data['description'];
        $category->status = $data['status'];

        $category->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::find($id)->delete();
        return redirect()->back();
    }
    public function resorting(Request $request){
        $data = $request->all();
        foreach($data['array_id'] as $key => $value){
            $category = Category::find($value);
            $category->position = $key;
            $category->save();
        }
    }
}
