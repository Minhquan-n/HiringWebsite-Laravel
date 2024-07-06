<?php

namespace App\Http\Controllers\Users\Taikhoan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserEducationFormController extends Controller
{
    public function index (Request $request) {
        // $username = $request -> session() -> get('username');
        $usrid = $request -> session() -> get('usr_id');
        $hinhdaidien = ((array)DB::table('usrpersonalinfo') -> where('id_user', $usrid) -> select('hinhdaidien') -> get()[0])['hinhdaidien'];

        $user_edu = DB::table('usreducation') -> where('id_user', $usrid) -> get();
        $education = [];
        for ( $i = 0; $i < count($user_edu); $i++) {
            $education[$i] = (array)$user_edu[$i];
        }
        $edu = $education[0];
        return view('user.taikhoan.hoso.profile_education_form', compact('hinhdaidien', 'edu'));
    }

    public function education (Request $request) {
        $usrid = $request -> session() -> get('usr_id');
        $education = DB::table('usreducation') -> where('id_user', $usrid)
                        -> update([
                            'truong' => $request -> input('education_school'),
                            'trinhdo' => $request -> input('education_level'),
                            'chuyennganh' => $request -> input('education_major'),
                            'xeploai' => $request -> input('education_classification'),
                            'nambatdau' => $request -> input('education_start'),
                            'namketthuc' => $request -> input('education_end')
                        ]);
        if ($education == 1) return redirect() -> back();
    }
}
