<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\View;
use Illuminate\Http\Request;

class ViewAPI extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $views = View::all();
        return $views;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return View::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $views = View::where('id', $id)->first();
        if(empty($views)){
            $data = [
                'status: ' => 'false',
                'message: ' => 'undefine'
            ];
            return response()->json($data);
        }else{
            return $views; 
        } 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        View::where('id', $id)->update($request->all());
        return View::where('id', $id)->first();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        View::where('id', $id)->delete();
        return View::all();
    }
}
