<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use App\Models\PromotionRequirement;

class Promotion extends Model
{
    use HasFactory;
    protected $table = 'promotion';
    protected $guarded = ['id'];

    public static function dt($user,$search,$start,$limit,$order,$dir){
        $data = Promotion::select("promotion.id","promotion.user","promotion.file","promotion.time","promotion.status","promotion.created_at","position.name as position")
            ->join("position","position.id","=","promotion.position")
            ->where("promotion.user",$user);
        $data = $search==""
            ? $data
            : $data->where("promotion.file","LIKE","%".$search."%")
                ->orWhere("promotion.time","LIKE","%".$search."%")
                ->orWhere("promotion.status","LIKE","%".$search."%")
                ->orWhere("position.name","LIKE","%".$search."%");
        return $data
            ->limit($limit)
            ->offset($start)
            ->orderBy($order,$dir)
            ->get();
    }

    public static function dtTotal($user,$search){
        $total = Promotion::select(DB::raw("count(promotion.id) as count"))
            ->where("promotion.user",$user)
            ->first()
            ->count;
        $filtered = $total;
        if($search!=""){
            $filtered = Promotion::select(DB::raw("count(promotion.id) as count"))
                ->join("position","position.id","=","promotion.position")
                ->where("promotion.user",$user)
                ->where("promotion.file","LIKE","%".$search."%")
                ->orWhere("promotion.time","LIKE","%".$search."%")
                ->orWhere("promotion.status","LIKE","%".$search."%")
                ->orWhere("position.name","LIKE","%".$search."%")
                ->first()
                ->count;
        }
        return (object)[
            "total" => $total,
            "filtered" => $filtered,
        ];
    }

    public static function Store($data){
        $Promotion = new Promotion();
        $Promotion->position = $data->position;
        $Promotion->time = 0;
        $Promotion->user = $data->user;
        $Promotion->status = "Draf";
        $Promotion->created_at = date("Y-m-d");

        if($data->hasFile("file")!=null){
            $Promotion->file = Storage::putFile('public', $data->file("file"));

            $history = Promotion::GetLastSuccess();
            if($history!=null){
                $Promotion->time = strtotime((string)Carbon::now()) - strtotime($history->created_at->add(config("data.promotion.contractLength"), 'year'));
            }
        }
        $ok = $Promotion->save();

        if(!$ok) return false;
        $data->id = $Promotion->id;

        return PromotionRequirement::Store($data);
    }

    public static function Put($data){
        $Promotion = Promotion::find($data['id']);
        $Promotion->position = $data->position;

        $isFileUploadedBefore = $Promotion->file!=null;
        $history = Promotion::GetLastSuccess();
        if($history!=null && !$isFileUploadedBefore){
            $Promotion->created_at = date("Y-m-d");
            $Promotion->time = strtotime((string)Carbon::now()) - strtotime($history->created_at->add(config("data.promotion.contractLength"), 'year'));
        }

        if($data->hasFile("file")!=null){
            $Promotion->file = Storage::putFile('public', $data->file("file"));
        }
        $ok = $Promotion->update();

        if(!$ok) return false;
        $data->id = $Promotion->id;

        return PromotionRequirement::Put($data);
    }

    public static function Process($data){
        $Promotion = Promotion::find($data['id']);
        $Promotion->status = "Diproses";
        return $Promotion->update();
    }

    public static function Deny($data){
        $Promotion = Promotion::find($data['id']);
        $Promotion->status = "Ditolak";
        return $Promotion->update();
    }

    public static function Approve($data){
        $Promotion = Promotion::find($data['id']);
        $Promotion->status = "Disetujui";
        $ok = $Promotion->update();

        if(!$ok) return false;
        return true;
    }

    public static function GetSuccess(){
        return Promotion::where("status","Disetujui")->get();
    }

    public static function GetLastSuccess(){
        return Promotion::where("status","Disetujui")->orderBy("id","desc")->first();
    }

    public static function GetLast(){
        return Promotion::orderBy("id","desc")->first();
    }
}
