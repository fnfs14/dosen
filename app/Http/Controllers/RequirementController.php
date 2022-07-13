<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Requirement;

class RequirementController extends Controller
{
    public function index(Request $r){
        AuthRevoke();
        $bearerToken = [
            "bearer-dt" => AuthCreateToken("requirement-index-dt",["requirement-dt"]),
            "bearer-destroy" => AuthCreateToken("requirement-index-destroy",["requirement-destroy"]),
        ];
        return view('master.requirement.index', compact("bearerToken"));
    }

    public function create(Request $r){
        AuthRevoke();
        $bearerToken = AuthCreateToken("requirement-create",["requirement-store"]);
        return view('master.requirement.form', compact("bearerToken"));
    }

    public function edit(Request $r,$id){
        AuthRevoke();
        $data = Requirement::findOrFail($id);
        $bearerToken = AuthCreateToken("requirement-edit",["requirement-update"]);
        return view('master.requirement.form', compact("bearerToken","data"));
    }
}
