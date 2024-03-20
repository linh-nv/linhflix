<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieAPI extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Movie::with('episode')->orderBy('created_day', 'desc')->take(20)->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return Movie::created($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $movies = Movie::with('episode')->where('id', $id)->first();
        return $movies; 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Movie::where('id', $id)->update($request->all());
        return Movie::with('episode')->where('id', $id)->first();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Movie::where('id', $id)->delete();
        return Movie::all();
    }
}
