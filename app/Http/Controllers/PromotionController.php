<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promotion;
use App\Models\Requirement;
use App\Models\PromotionRequirement;
use App\Models\User;

class PromotionController extends Controller
{
    public function index(Request $r,$u=null){
        AuthRevoke();
        $bearerToken = [
            "bearer-dt" => AuthCreateToken("promote-index-dt",["promote-dt"]),
            "bearer-destroy" => AuthCreateToken("promote-index-destroy",["promote-destroy"]),
            "bearer-process" => AuthCreateToken("promote-index-process",["promote-process"]),
            "promote-user" => $u!=null && auth()->user()->role=="Admin" ? $u : auth()->user()->id,
            "is-admin" => auth()->user()->role=="Admin" ? 1 : 0,
        ];
        return view('master.promote.index', compact("bearerToken"));
    }

    public function create(Request $r){
        $url = "promote";
        $method = "warning";

        $data = Promotion::GetLast();
        if($data!=null && ($data->status!="Disetujui")){
            $message = "Ada pengajuan yang sedang berjalan";
            return view("errors.setNotification", compact("url","message","method"));
        }

        AuthRevoke();
        $requirements = Requirement::get();
        $bearerToken = [
            "bearer-position" => AuthCreateToken("promote-create-position",["position-select2"]),
            "bearer-save" => AuthCreateToken("promote-create-save",["promote-store"]),
        ];
        return view('master.promote.form', compact("bearerToken","requirements"));
    }

    public function edit(Request $r,$id){
        AuthRevoke();
        $data = Promotion::findOrFail($id);

        $url = "promote";
        $method = "warning";
        if($data->status=="Diproses"){
            $message = "Pengajuan sedang diproses";
            return view("errors.setNotification", compact("url","message","method"));
        }else if($data->status=="Disetujui"){
            $message = "Pengajuan sudah selesai";
            return view("errors.setNotification", compact("url","message","method"));
        }

        $data->requirement = PromotionRequirement::data($id);
        $requirements = Requirement::get();
        $bearerToken = [
            "bearer-position" => AuthCreateToken("promote-create-position",["position-select2"]),
            "bearer-save" => AuthCreateToken("promote-create-save",["promote-update"]),
        ];
        return view('master.promote.form', compact("bearerToken","data","requirements"));
    }

    public function show(Request $r,$id){
        AuthRevoke();
        $data = Promotion::findOrFail($id);

        $data->requirement = PromotionRequirement::data($id);
        $data->user = User::findOrFail($data->user);
        $requirements = Requirement::get();
        $bearerToken = [
            "bearer-deny" => AuthCreateToken("promote-show-deny",["promote-deny"]),
            "bearer-approve" => AuthCreateToken("promote-show-approve",["promote-approve"]),
            "is-admin" => auth()->user()->role=="Admin" ? 1 : 0,
            "promote-user" => $data->user->id,
        ];
        return view('master.promote.show', compact("bearerToken","data","requirements"));
    }
}
