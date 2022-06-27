<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rank;

class RankController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $r){
        $bearerToken = [
            "bearer-dt" => AuthCreateToken("rank-index-dt",["rank-dt"]),
            "bearer-destroy" => AuthCreateToken("rank-index-destroy",["rank-destroy"]),
        ];
        return view('master.rank.index', compact("bearerToken"));
    }

    public function create(Request $r){
        $bearerToken = [
            "bearer-save" => AuthCreateToken("rank-create-save",["rank-store"]),
            "bearer-position" => AuthCreateToken("rank-create-position",["position-select2"]),
        ];
        return view('master.rank.form', compact("bearerToken"));
    }

    public function edit(Request $r,$id){
        $data = Rank::findOrFail($id);
        $bearerToken = [
            "bearer-save" => AuthCreateToken("rank-create-save",["rank-update"]),
            "bearer-position" => AuthCreateToken("rank-create-position",["position-select2"]),
        ];
        return view('master.rank.form', compact("bearerToken","data"));
    }
}
