<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Position;

class PositionController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $r){
        $bearerToken = [
            "bearer-dt" => AuthCreateToken("position-index-dt",["position-dt"]),
            "bearer-destroy" => AuthCreateToken("position-index-destroy",["position-destroy"]),
        ];
        return view('master.position.index', compact("bearerToken"));
    }

    public function create(Request $r){
        $bearerToken = AuthCreateToken("position-create",["position-store"]);
        return view('master.position.form', compact("bearerToken"));
    }

    public function edit(Request $r,$id){
        $data = Position::findOrFail($id);
        $bearerToken = AuthCreateToken("position-edit",["position-update"]);
        return view('master.position.form', compact("bearerToken","data"));
    }
}
