<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Friends;
use App\Profile;

class FriendController extends Controller
{
    public function getByUid($uid)
    {
    	$error = false;
    	//$friends=Friends::where('uid', $uid)->orWhere('friend', $uid)->with('profile')->get();
    	$friends=Friends::where('uid', $uid)->with('profile')->get();

    	if(sizeof($friends)<1) // get array length
    	{
    		return json_encode(['error' => true, 'error_msg' => 'Data not found!']);
    	}

    	return [
            'error' => $error,
            'friends' => $friends
        ];
    }

    public function getByName($name)
    {
        $error = false;
        //$friends=Friends::where('uid', $uid)->orWhere('friend', $uid)->with('profile')->get();
        $friends=Friends::where('name', $name)->with('profile')->get();

        if(sizeof($friends)<1) // get array length
        {
            return json_encode(['error_msg' => true, 'error_msg' => 'Data not found!']);
        }

        return [
            'error' => $error,
            'friends' => $friends
        ];
    }

    public function getFriendRequest($friend)
    {
    	$error = false;
    	//$friends=Friends::where('uid', $uid)->orWhere('friend', $uid)->with('profile')->get();
    	$friends=Friends::where('friend', $friend)->where('status', 'waiting')->with('friendreq')->get();

    	if(sizeof($friends)<1) // get array length
    	{
    		return json_encode(['error' => true, 'error_msg' => 'Data not found!']);
    	}

    	return [
            'error' => $error,
            'friends' => $friends
        ];
    }

    public function addFriend(Request $request)
    {   

    	$error = false;

        $addFriend = new Friends;
        $addFriend->create([
            'uid' => $request['uid'], // uid user yg ngeadd
            'friend' => $request['friend'], // uid user yg di add
        ]);

        return [
            'error' => $error,
            'user' => array($request->all()),
        ];
    }

    public function confirm(Request $request)
    {
    	$error = false;

    	$user1 = $request['uid'];
    	$user2 = $request['friend'];

    	$confirmation=Friends::where('uid', $user1)->where('friend', $user2)->first()->update(['status' => 'accepted']);

    	// kalo udah dikonfirmasi
		$addFriend = new Friends;
        $addFriend->create([
            'uid' => $user2, 
            'friend' => $user1,
            'status' => 'accepted',
        ]);

    	return [
            'error' => $error,
            'user' => array($request->all()),
        ];
    }

    public function decline(Request $request)
    {
    	$error = false;

    	$user1 = $request['uid'];
    	$user2 = $request['friend'];

    	$confirmation=Friends::where('uid', $user1)->where('friend', $user2)->delete();

    	return [
            'error' => $error,
            'user' => array($request->all()),
        ];
    }

    /*public function remove(Request $request)
    {
        $error = false;

        $user1 = $request['uid'];
        $user2 = $request['friend'];

        $remove=Friends::where('uid', $user1)->where('friend', $user2)->where('status', 'accepted')->delete();

        return [
            'error' => $error,
            'user' => array($request->all()),
        ];
    }*/

    public function remove(Request $request)
    {
        $error = false;

        $user1 = $request['uid'];
        $user2 = $request['friend'];

        $remove=Friends::where('uid', $user1)->where('friend', $user2)->delete();

        return [
            'error' => $error,
            'user' => array($request->all()),
        ];
    }
}
