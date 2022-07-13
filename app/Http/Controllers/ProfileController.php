<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Level;

class ProfileController extends Controller
{
    public function __invoke(Request $r){
        AuthRevoke();
        $bearerToken = [
            "bearer-dt" => AuthCreateToken("level-index-dt",["level-dt"]),
            "bearer-destroy" => AuthCreateToken("level-index-destroy",["level-destroy"]),
        ];
        return view('profile', compact("bearerToken"));
    }
}
