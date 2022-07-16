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
            "promote-user" => $u!=null && AuthIsAdmin() ? $u : auth()->user()->id,
            "is-admin" => AuthIsAdmin() ? 1 : 0,
        ];
        $user = $u!=null && AuthIsAdmin() ? User::select("name")->where("id",$u)->firstOrFail() : false;
        return view('promote.index', compact("bearerToken", "user"));
    }

    public function create(Request $r){
        $url = "promote";
        $method = "warning";

        $data = Promotion::GetLast(AuthUser("id"));
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
        return view('promote.form', compact("bearerToken","requirements"));
    }

    public function edit(Request $r,$id){
        AuthRevoke();
        $data = Promotion::findOrFail($id);

        $url = "promote";
        $method = "warning";
        if($data->status=="Diajukan"){
            $message = "Pengajuan sedang diajukan";
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
        return view('promote.form', compact("bearerToken","data","requirements"));
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
            "is-admin" => AuthIsAdmin() ? 1 : 0,
            "promote-user" => $data->user->id,
        ];
        return view('promote.show', compact("bearerToken","data","requirements"));
    }

    public function list($r,$status=""){
        AuthRevoke();
        $bearerToken = [
            "bearer-dt" => AuthCreateToken("promote-list-dt",["promote-dt"]),
            "promote-status" => $status,
        ];
        return view('promote.list', compact("bearerToken"));
    }

    public function draf(Request $r){ return $this->list($r,"Draf"); }
    public function diajukan(Request $r){ return $this->list($r,"diajukan"); }
    public function ditolak(Request $r){ return $this->list($r,"ditolak"); }
    public function disetujui(Request $r){ return $this->list($r,"disetujui"); }
}
