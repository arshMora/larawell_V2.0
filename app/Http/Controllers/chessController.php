<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\chessModel;

class chessController extends Controller
{
    public function getUsers() {
        
        $user=chessModel::get();

        return response()->json($user);
        
    }

    public function addUsers(Request $req) {
        
        $user = new chessModel();

        $user->name=$req->name;
        $user->password=$req->password;
        $k=$user->save();
        if ($k)
            return 'user added';
        return 'err';         

    }   

    public function updateUsers(Request $req) {
        
        $user = chessModel::where('id',$req->id)->first();

        $user->name = $req->name;
        $user->password = $req->password;
        $k=$user->save();
        if ($k)
            return 'user update';
        return 'err'; 

    }

    public function deleteUsers(Request $req) {
        
        $user = chessModel::where('id',$req->id)->first();
        
        $k=$user->delete();
        if ($k)
            return 'user deleted';
        return 'err'; 

    }
    
    public function signUp(Request $req) {
        
        $validator = Validator::make($req->all(),[
            'name'=>'required|min:2|max:50|unique:users',
            'password'=>'required|min:5|max:50'
        ]);
        
        if ($validator->fails()) 
            return response()->json($validator->errors());
        
        chessModel::create($req->all());
        return response()->json('successful registration');   

    }

    public function login(Request $req) {

        $validator = Validator::make($req->all(),[
            'name' => 'required',
            'password'=>'required', 
        ]);

        if ($validator->fails())
            return response()->json($validator->errors());

        if ($user = chessModel::Where('name',$req->name)->first()) {
            if ($req->password == $user->password) {
                $user->api_token=str_random(50);
                $user->save();
                return response()->json('successful login');
            }
        }
        return response()->json('incorrect data');   

    }

    public function logout(Request $req) { 

        $user = chessModel::where('api_token',$req->api_token)->first();

        if ($user) {
            $user->api_token=null;
            $user->save();
            return response()->json('successful logout');
        }

        return response()->json('err');

    }
}
