<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Requirement;

class RequirementController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $r){
        $bearerToken = [
            "bearer-dt" => AuthCreateToken("requirement-index-dt",["requirement-dt"]),
            "bearer-destroy" => AuthCreateToken("requirement-index-destroy",["requirement-destroy"]),
        ];
        return view('master.requirement.index', compact("bearerToken"));
    }

    public function create(Request $r){
        $bearerToken = AuthCreateToken("requirement-create",["requirement-store"]);
        return view('master.requirement.form', compact("bearerToken"));
    }

    public function edit(Request $r,$id){
        $data = Requirement::findOrFail($id);
        $bearerToken = AuthCreateToken("requirement-edit",["requirement-update"]);
        return view('master.requirement.form', compact("bearerToken","data"));
    }
}
