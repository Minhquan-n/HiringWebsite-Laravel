<?php

namespace App\Http\Controllers\Admins\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminAccountController extends Controller
{
    public function index (Request $request) {
        $title = 'Minh Quân';
        $token = $request -> session() -> token();
        $token = csrf_token();
        $post = (array)(DB::table('posts') -> get());

        return response() -> json($post);
    }
}
