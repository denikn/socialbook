<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Books;
use App\Chapter;
use App\Friends;
use App\Messageboard;
use App\Library;
use App\Bookmark;
use App\BookmarkChapter;
use App\Media;
use App\Notes;

class BookController extends Controller
{
    public function getByTitle($title)
    {
    	$error = false;
    	//$friends=Friends::where('uid', $uid)->orWhere('friend', $uid)->with('profile')->get();
    	$books=Books::where('title', 'like', '%'.$title.'%')->with('chapter')->get();

    	if(sizeof($books)<1) // get array length
    	{
    		return json_encode(['error' => true, 'error_msg' => 'Data not found!']);
    	}

    	return [
            'error' => $error,
            'books' => $books
        ];
    }

    public function getById($id_books)
    {
        $error = false;
        //$friends=Friends::where('uid', $uid)->orWhere('friend', $uid)->with('profile')->get();
        $books=Books::where('id_books', 'like', '%'.$id_books.'%')->with('chapter')->get();

        if(sizeof($books)<1) // get array length
        {
            return json_encode(['error' => true, 'error_msg' => 'Data not found!']);
        }

        return [
            'error' => $error,
            'books' => $books
        ];
    }

    public function showMessageboard($id_books, $id_chapter)
    {
        $error = false;

        $msgbrd=Messageboard::where('id_books', 'like', '%'.$id_books.'%')->where('id_chapter', 'like', $id_chapter)->orderBy('id_message', 'ASC')->with('showID')->get();

        if(sizeof($msgbrd)<1) // get array length
        {
            return json_encode(['error' => true, 'error_msg' => 'Messageboard is empty!']);
        }

        return [
            'error' => $error,
            'books' => $msgbrd
        ];
    }

    public function getWithMessageboard($title)
    {
    	$error = false;
    	//$friends=Friends::where('uid', $uid)->orWhere('friend', $uid)->with('profile')->get();
    	$books=Books::where('title', 'like', '%'.$title.'%')->orderBy('id_message', 'ASC')->with('messageboard.showFriend')->get();

    	if(sizeof($books)<1) // get array length
    	{
    		return json_encode(['error' => true, 'error_msg' => 'Messageboard is empty!']);
    	}

    	return [
            'error' => $error,
            'books' => $books
        ];
    }

    public function checkUpdateMessageboard($id_books, $id_chapter)
    {
        $error = false;
        $empty = false;
        //$friends=Friends::where('uid', $uid)->orWhere('friend', $uid)->with('profile')->get();
        $check=Messageboard::where('id_books', 'like', $id_books)->where('id_chapter', 'like', $id_chapter)->max('updated_at');

        if(sizeof($check)<1) // get array length
        {
            return json_encode(['error' => false, 'empty' => true]);
        }

        /*return [
            array('error' => $error,
                array('empty' => $empty,
                    array('updated_at' => $check)))
        ];*/

        return [
            'error' => $error,
            'empty' => $empty,
            'updated_at' => $check,
        ];
    }

    public function getWithNotes($title)
    {
    	$error = false;
    	//$friends=Friends::where('uid', $uid)->orWhere('friend', $uid)->with('profile')->get();
    	$books=Books::where('title', 'like', '%'.$title.'%')->with('chapter.notes')->get();

    	if(sizeof($books)<1) // get array length
    	{
    		return json_encode(['error' => true, 'error_msg' => 'Data not found!']);
    	}

    	return [
            'error' => $error,
            'books' => $books
        ];
    }

    /*public function sendComment(Request $request)
    {
        $error = false;

        $sendCmt = new Messageboard;
        $sendCmt->create([
                'id_forum' => $request['id_books']
            ])
    }*/

    public function sendMessageboard(Request $request)
    {   

    	$error = false;

        $sendMsg = new Messageboard;
        $sendMsg->create([
            'id_books' => $request['id_books'],
            'id_chapter' => $request['id_chapter'],
            'uid' => $request['uid'],
            'message' => $request['message'],
            'parent' => $request['parent'],
            'media' => $request['media'],
            'type' => $request['type'],
        ]);

        return [
            'error' => $error,
            'user' => array($request->all()),
        ];
    }

    /*public function getMedia($media)
    {
        $error = false;

        $books=Bookmark::where('uid', $uid)->with('books')->get();

        return [
            'error' => $error,
            'bookmark' => $books,
        ];
    }*/

    public function sendBookmark(Request $request)
    {   

    	$error = false;

        $bookmark = new Bookmark;
        $bookmark->create([
            'id_books' => $request['id_books'],
            'uid' => $request['uid'],
        ]);

        return [
            'error' => $error,
            'user' => array($request->all()),
        ];
    }

    // last updated
    public function sendBookmarkChapter(Request $request)
    {   

        $error = false;

        $bookmark = new BookmarkChapter;
        $bookmark->create([
            'id_books' => $request['id_books'],
            'id_chapter' => $request['id_chapter'],
            'uid' => $request['uid'],
        ]);

        return [
            'error' => $error,
            'user' => array($request->all()),
        ];
    }

    public function getBookmark($uid)
    {
    	$error = false;

    	$books=Bookmark::where('uid', $uid)->with('books')->get();

    	return [
            'error' => $error,
            'bookmark' => $books,
        ];
    }

    public function getLibrary($uid)
    {
    	$error = false;

    	$books=Library::where('uid', 'like', '%'.$uid.'%')->with('books')->get();

    	return [
            'error' => $error,
            'library' => $books,
        ];
    }

    public function deleteBook(Request $request)
    {
        $error = false;

        $uid = $request['uid'];
        $id_books = $request['id_books'];

        $confirmation=Library::where('uid', $uid)->where('id_books', $id_books)->delete();

        return [
            'error' => $error,
            'user' => array($request->all()),
        ];
    }

    public function deleteBookFromBookmark(Request $request)
    {
        $error = false;

        $uid = $request['uid'];
        $id_books = $request['id_books'];

        $confirmation=Bookmark::where('uid', $uid)->where('id_books', $id_books)->delete();

        return [
            'error' => $error,
            'user' => array($request->all()),
        ];
    }

    public function deleteChapterFromBookmark(Request $request)
    {
        $error = false;

        $uid = $request['uid'];
        $id_books = $request['id_books'];        
        $id_chapter = $request['id_chapter'];

        $confirmation=BookmarkChapter::where('uid', $uid)->where('id_books', $id_books)->where('id_chapter', $id_chapter)->delete();

        return [
            'error' => $error,
            'user' => array($request->all()),
        ];
    }

    public function sendLibrary(Request $request)
    {   

    	$error = false;

        $library = new Library;
        $library->create([
            'id_books' => $request['id_books'],
            'uid' => $request['uid'],
        ]);

        return [
            'error' => $error,
            'user' => array($request->all()),
        ];
    }

    // ----------------------------------------------
    public function getImage($id_books, $id_chapter)
    {
        $error = false;

        $media=Media::where('id_books', 'like', $id_books)->where('id_chapter', 'like', $id_chapter)->where('type', 'like', 'image')->get();

        if(sizeof($media)<1) // get array length
        {
            return json_encode(['error' => true, 'error_msg' => 'Data not found!']);
        }

        return [
            'error' => $error,
            'media' => $media,
        ];
    }

    public function getAudio($id_books, $id_chapter)
    {
        $error = false;

        $media=Media::where('id_books', 'like', $id_books)->where('id_chapter', 'like', $id_chapter)->where('type', 'like', 'audio')->get();

        if(sizeof($media)<1) // get array length
        {
            return json_encode(['error' => true, 'error_msg' => 'Data not found!']);
        }

        return [
            'error' => $error,
            'media' => $media,
        ];
    }

    public function getVideo($id_books, $id_chapter)
    {
        $error = false;

        $media=Media::where('id_books', 'like', $id_books)->where('id_chapter', 'like', $id_chapter)->where('type', 'like', 'video')->get();

        if(sizeof($media)<1) // get array length
        {
            return json_encode(['error' => true, 'error_msg' => 'Data not found!']);
        }

        return [
            'error' => $error,
            'media' => $media,
        ];
    }

    public function getNotes($uid, $id_books, $id_chapter)
    {
        $error = false;

        $notes=Notes::where('uid', 'like', $uid)->where('id_books', 'like', $id_books)->where('id_chapter', 'like', $id_chapter)->get();

        if(sizeof($notes)<1) // get array length
        {
            return json_encode(['error' => true, 'error_msg' => 'Data not found!']);
        }

        return [
            'error' => $error,
            'notes' => $notes,
        ];
    }

    public function addNotes(Request $request)
    {   

        $error = false;

        $notes = new Notes;
        $notes->create([
            'id_books' => $request['id_books'],
            'id_chapter' => $request['id_chapter'],
            'note' => $request['note'],
            'uid' => $request['uid'],
        ]);

        return [
            'error' => $error,
            'notes' => array($request->all()),
        ];
    }

    public function updateNotes(Request $request)
    {
        $error = false;

        $uid = $request['uid'];
        $id_notes = $request['id_notes'];

        $confirmation=Notes::where('uid', $uid)->where('id_notes', $id_notes)->delete();

        $notes = new Notes;
        $notes->create([
            'id_books' => $request['id_books'],
            'id_chapter' => $request['id_chapter'],
            'note' => $request['note'],
            'uid' => $request['uid'],
        ]);


        return [
            'error' => $error,
            'notes' => $request->all(),
        ];
    }

    public function deleteNotes(Request $request)
    {
        $error = false;

        $uid = $request['uid'];
        $id_notes = $request['id_notes'];

        $confirmation=Notes::where('uid', $uid)->where('id_notes', $id_notes)->delete();

        return [
            'error' => $error,
            'user' => array($request->all()),
        ];
    }
}
