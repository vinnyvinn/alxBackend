<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UsersController extends Controller
{
   /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails())
        {
          return response(['errors'=>$validator->errors()->all()], 422);
        }
        $request['name'] = $request->get('username');
        $request['email_verified_at'] = now();
        $request['password'] = Hash::make($request['password']);
        $request['remember_token'] = Str::random(10);
        $user = User::create($request->toArray());
        $token = $user->createToken('Laravel Password Grant Client')->accessToken;
        $response = ['email'=>$user->email,'username'=>$user->name,'token'=>$token];
        return response($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    //Login User
    public function login (Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $response = ['email'=>$user->email,'username'=>$user->name,'token'=>$token];
                return response($response, 200);
            } else {
                return response(['errors'=>["Password mismatch"]], 422);
            }
        } else {
            return response(['errors'=>["User does not exist"]], 404);
        }
    }

    //Verify User
    public function verify(Request $request)
    {
        if ($user = User::select("name","email")->where("email",$request->get('email'))->first()){
            return response($user,200);
        }
        return response(['errors'=>["Invalid Credentials"]],422);
    }

}
