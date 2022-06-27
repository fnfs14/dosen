<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Major;

class MajorController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $r){
        $bearerToken = [
            "bearer-dt" => AuthCreateToken("major-index-dt",["major-dt"]),
            "bearer-destroy" => AuthCreateToken("major-index-destroy",["major-destroy"]),
        ];
        return view('master.major.index', compact("bearerToken"));
    }

    public function create(Request $r){
        $bearerToken = [
            "bearer-save" => AuthCreateToken("major-create-save",["major-store"]),
            "bearer-college" => AuthCreateToken("major-create-college",["college-select2"]),
            "bearer-stage" => AuthCreateToken("major-create-stage",["stage-select2"]),
        ];
        return view('master.major.form', compact("bearerToken"));
    }

    public function edit(Request $r,$id){
        $data = Major::findOrFail($id);
        $bearerToken = [
            "bearer-save" => AuthCreateToken("major-create-save",["major-update"]),
            "bearer-college" => AuthCreateToken("major-create-college",["college-select2"]),
            "bearer-stage" => AuthCreateToken("major-create-stage",["stage-select2"]),
        ];
        return view('master.major.form', compact("bearerToken","data"));
    }
}
