<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Level;

class LevelController extends Controller
{
    public function index(Request $r){
        AuthRevoke();
        $bearerToken = [
            "bearer-dt" => AuthCreateToken("level-index-dt",["level-dt"]),
            "bearer-destroy" => AuthCreateToken("level-index-destroy",["level-destroy"]),
        ];
        return view('master.level.index', compact("bearerToken"));
    }

    public function create(Request $r){
        AuthRevoke();
        $bearerToken = [
            "bearer-save" => AuthCreateToken("level-create-save",["level-store"]),
            "bearer-rank" => AuthCreateToken("level-create-rank",["rank-select2"]),
        ];
        return view('master.level.form', compact("bearerToken"));
    }

    public function edit(Request $r,$id){
        AuthRevoke();
        $data = Level::findOrFail($id);
        $bearerToken = [
            "bearer-save" => AuthCreateToken("level-create-save",["level-update"]),
            "bearer-rank" => AuthCreateToken("level-create-rank",["rank-select2"]),
        ];
        return view('master.level.form', compact("bearerToken","data"));
    }
}
