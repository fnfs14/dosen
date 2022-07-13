<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Position;

class PositionController extends Controller
{
    public function index(Request $r){
        AuthRevoke();
        $bearerToken = [
            "bearer-dt" => AuthCreateToken("position-index-dt",["position-dt"]),
            "bearer-destroy" => AuthCreateToken("position-index-destroy",["position-destroy"]),
        ];
        return view('master.position.index', compact("bearerToken"));
    }

    public function create(Request $r){
        AuthRevoke();
        $bearerToken = AuthCreateToken("position-create",["position-store"]);
        return view('master.position.form', compact("bearerToken"));
    }

    public function edit(Request $r,$id){
        AuthRevoke();
        $data = Position::findOrFail($id);
        $bearerToken = AuthCreateToken("position-edit",["position-update"]);
        return view('master.position.form', compact("bearerToken","data"));
    }
}
