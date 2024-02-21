<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;

use App\Models\User;

class UserController extends Controller
{
    public function __construct() {

    }

    public function index(){
        return view('pages.crud');
    }

    public function show(){
        $users = User::all();

        return response()->json([
            'users' => $users,
            'code' => 200
        ]);
    }

    public function create(UserRequest $request){
        $request->validated();
        $users = User::create(
            $request->only([
                'name',
                'email',
                'contact'
            ])
        );

        return response([
            'users' => $users
        ], 201);
    }

    public function update(UserRequest $request){
        $request->validated();
        $users = User::find($request->id);
        $users->update(
            $request->only([
                'name',
                'email',
                'contact'
            ])
        );

        return response([
            'users' => $users
        ], 201);
    }

    public function delete(UserRequest $request){
        $users = User::find($request->id);
        $users->delete();

        return response([
            'users' => $users
        ], 201);
    }

}
