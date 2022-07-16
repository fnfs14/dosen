<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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

    public function edit(Request $r, $id){
        AuthRevoke();
        $data = User::findOrFail($id);
        $data->birth_date = date("Y-m-d",strtotime($data->birth_date));
        $bearerToken = AuthCreateToken("lecturer-create",["user-update"]);
        return view('master.lecturer.form', compact("bearerToken","data"));
    }
}
