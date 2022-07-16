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

    public static function dt($search,$start,$limit,$order,$dir){
        $data = Promotion::select("promotion.id","promotion.user","promotion.file","promotion.time","promotion.status","promotion.created_at","position.name as position")
            ->join("position","position.id","=","promotion.position");

        $data = $search->user==null ? $data : $data->where("promotion.user",$search->user);

        $data = $search->status==null ? $data : $data->where("promotion.status",$search->status);

        $data = $search->value==null
            ? $data
            : $data->where("promotion.file","LIKE","%".$search->value."%")
                ->orWhere("promotion.time","LIKE","%".$search->value."%")
                ->orWhere("promotion.status","LIKE","%".$search->value."%")
                ->orWhere("position.name","LIKE","%".$search->value."%");

        return $data
            ->limit($limit)
            ->offset($start)
            ->orderBy($order,$dir)
            ->get();
    }

    public static function dtTotal($search){
        $total = Promotion::select(DB::raw("count(promotion.id) as count"));
        $total = $search->user==null ? $total : $total->where("promotion.user",$search->user);
        $total = $search->status==null ? $total : $total->where("promotion.status",$search->status);
        $total = $total->first()->count;

        $filtered = $total;
        if($search->value!=null){
            $filtered = Promotion::select(DB::raw("count(promotion.id) as count"))
                ->join("position","position.id","=","promotion.position");
            $filtered = $search->user==null ? $filtered : $filtered->where("promotion.user",$search->user);
            $filtered = $search->status==null ? $filtered : $filtered->where("promotion.status",$search->status);
            $filtered = $filtered->where("promotion.user",$search->user)
                ->where("promotion.file","LIKE","%".$search->value."%")
                ->orWhere("promotion.time","LIKE","%".$search->value."%")
                ->orWhere("promotion.status","LIKE","%".$search->value."%")
                ->orWhere("position.name","LIKE","%".$search->value."%")
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
        $Promotion->status = "Diajukan";
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
        return $Promotion->update();
    }

    public static function GetSuccess(){
        return Promotion::where("status","Disetujui")->get();
    }

    public static function GetLastSuccess(){
        return Promotion::where("status","Disetujui")->orderBy("id","desc")->first();
    }

    public static function GetLast($id=null){
        $data = Promotion::orderBy("id","desc");
        $data = $id==null ? $data : $data->where("user",$id);
        return $data->first();
    }

    public static function GetAmountStatus(){
        return (object)[
            "draf" => Promotion::where("status","Draf")->count(),
            "diajukan" => Promotion::where("status","Diajukan")->count(),
            "ditolak" => Promotion::where("status","Ditolak")->count(),
            "disetujui" => Promotion::where("status","Disetujui")->count(),
        ];
    }
}
