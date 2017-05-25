<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'login',
        'register',
        'get_user/register', 
        'get_friend/add', 
        'get_friend/confirm',
        'get_friend/decline',
        'get_friend/remove',
        'get_book/sendmessageboard',
        'get_book/sendlibrary',
        'get_book/sendbookmark',
        'get_book/delete',
        'get_book/notes/sendnotes',
        'get_book/notes/deletenotes',
        'get_book/bookmark/deletebookmark',

        'get_book/sendbookmarkchapter',
        'get_book/bookmark/deletebookmarkchapter',
        'get_book/updatenotes'
    ];
}
