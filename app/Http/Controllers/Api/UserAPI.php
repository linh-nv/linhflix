<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserAPI extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return $users;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return User::create($request->all());
        // return $request;
        return User::all();
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $users = User::where('email', $request->email)->where('password', md5($request->password))->first();
        if(empty($users)){
            $data = [
                'status: ' => 'false',
                'message: ' => 'undefine'
            ];
            return response($data, Response::HTTP_NOT_FOUND);
        }else{
            return $users; 
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        User::where('id', $id)->update($request->all());
        return User::where('id', $id)->first();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::where('id', $id)->delete();
        return User::all();
    }
}
