<?php

namespace App\Http\Controllers\Users\Taikhoan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserSkillController extends Controller
{
    public function index (Request $request) {
        $usrid = $request -> session() -> get('usr_id');
        $hinhdaidien = ((array)DB::table('usrpersonalinfo') -> where('id_user', $usrid) -> select('hinhdaidien') -> get()[0])['hinhdaidien'];
        $data = DB::table('usrskill') -> where('id_user', $usrid) -> get();
        $skill = (array)$data[0];
        return view('user.taikhoan.hoso.profile_skill_form', compact('hinhdaidien', 'skill'));
    }

    public function skill (Request $request) {
        $usrid = $request -> session() -> get('usr_id');
        $skill = DB::table('usrskill') -> where('id_user', $usrid)
                    -> update([
                        'tinhoc' => $request -> input('skill_computer'),
                        'ngoaingu' => $request -> input('skill_language'),
                        'skillkhac' => $request -> input('skill_another')
                    ]);
        if ($skill == 1) return redirect() -> back();
    }
}
