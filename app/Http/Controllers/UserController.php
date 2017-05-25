<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Login;
use App\Profile;

class UserController extends Controller
{

	public function index()
    {
    	$error = false;
    	$user=Login::with('profile')->get();

    	if(sizeof($user)<1) // get array length
    	{
    		return json_encode(['error' => true, 'error_msg' => 'Data not found!']);
    	}

    	return [
            'error' => $error,
            'user' => $user
        ];
    }

    public function login($email, $password)
    {
        $error = false;
        $user=Login::with('profile')->where('email', 'like', $email)->where('password', 'like', $password)->get();

        if(sizeof($user)<1) // get array length
        {
            return json_encode(['error' => true, 'error_msg' => 'Data not found!']);
        }

        return [
            'error' => $error,
            'user' => $user
        ];
    }

    public function getByName($name)
    {
    	$error = false;
    	//$friends=Friends::where('uid', $uid)->orWhere('friend', $uid)->with('profile')->get();
    	$users=Profile::where('name', 'like', '%'.$name.'%')->get();

    	if(sizeof($users)<1) // get array length
    	{
    		return json_encode(['error' => true, 'error_msg' => 'Data not found!']);
    	}

    	return [
            'error' => $error,
            'users' => $users
        ];
    }

	public function register(Request $request)
    {   

        $uid = uniqid();

        $register = new Login;
        $register->create([
            'uid' => $uid,
            'email' => $request['email'],
            'username' => $request['username'],
            'password' => $request['password'],
        ]);

        /*$createidentity = new Profile;
        $createidentity->create(
            $request->only([
                'unique_id' => uniqid($request['username']), 'avatar', 'name', 'affiliation', 'origin', 'about',
                ])
        );*/
        
        //$ava->save();

        $createidentity = new Profile;
        $createidentity->create([
            'uid' => $uid,
            //'avatar' => $unique_id . '.png',
            'name' => $request['name'],
            'avatar' => $request['avatar'],
            'origin' => $request['origin'],
            'about' => $request['about'],
        ]);

        /*$ava = new Profile;

        $imageName = $ava->$unique_id . '.' . 
        $request->file('avatar')->getClientOriginalExtension();

        $request->file('avatar')->move(
            public_path() . '/images/avatar/', $imageName
        );

        $ava->save();*/


        //$request->save();
        return $request->all();


    }

    public function getByUid($uid)
    {
    	$error = false;
    	$user=Login::where('uid', $uid)->with('profile')->get();

    	if(sizeof($user)<1) // get array length
    	{
    		return json_encode(['error' => true, 'error_msg' => 'Data not found!']);
    	}

    	return [
            'error' => $error,
            'user' => $user
        ];
    }
}
