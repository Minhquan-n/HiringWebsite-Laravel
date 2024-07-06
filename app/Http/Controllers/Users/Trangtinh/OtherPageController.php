<?php

namespace App\Http\Controllers\Users\Trangtinh;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OtherPageController extends Controller
{
    public function gioithieu () {
        $title = 'Giới thiệu';
        return view('user.gioithieu', compact('title'));
    }

    public function lienhe () {
        $title = 'Liên hệ';
        return view('user.lienhe', compact('title'));
    }
}
