<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\College;

class CollegeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $r){
        $bearerToken = [
            "bearer-dt" => AuthCreateToken("college-index-dt",["college-dt"]),
            "bearer-destroy" => AuthCreateToken("college-index-destroy",["college-destroy"]),
        ];
        return view('master.college.index', compact("bearerToken"));
    }

    public function create(Request $r){
        $bearerToken = AuthCreateToken("college-create",["college-store"]);
        return view('master.college.form', compact("bearerToken"));
    }

    public function edit(Request $r,$id){
        $data = College::findOrFail($id);
        $bearerToken = AuthCreateToken("college-edit",["college-update"]);
        return view('master.college.form', compact("bearerToken","data"));
    }
}
