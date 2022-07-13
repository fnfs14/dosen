<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LecturerController extends Controller
{
    public function index(Request $r){
        AuthRevoke();
        if(auth()->user()->role!="Admin") return redirect("/master");

        $bearerToken = AuthCreateToken("lecturer-index",["user-dt"]);
        return view('master.lecturer.index', compact("bearerToken"));
    }

    public function create(Request $r){
        AuthRevoke();
        $bearerToken = AuthCreateToken("lecturer-create",["user-store"]);
        return view('master.lecturer.form', compact("bearerToken"));
    }
}
