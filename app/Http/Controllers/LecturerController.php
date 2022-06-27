<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LecturerController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $r){
        $bearerToken = AuthCreateToken("lecturer-index",["user-dt"]);
        return view('lecturer.index', compact("bearerToken"));
    }

    public function create(Request $r){
        $bearerToken = AuthCreateToken("lecturer-create",["user-store"]);
        return view('lecturer.form', compact("bearerToken"));
    }
}
