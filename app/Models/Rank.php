<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Rank extends Model
{
    use HasFactory;
    protected $table = 'rank';
    protected $guarded = ['id'];

    public static function dt($search,$start,$limit,$order,$dir){
        $data = Rank::select("rank.id","rank.name","position.name as position")
            ->join("position","position.id","=","rank.position");
        if($search!=""){
            $data->where("rank.name","LIKE","%".$search."%")
                ->orWhere("position.name","LIKE","%".$search."%");
        }
        return $data
            ->limit($limit)
            ->offset($start)
            ->orderBy($order,$dir)
            ->get();
    }

    public static function dtTotal($search){
        $total = Rank::select(DB::raw("count(rank.id) as count"))
            ->first()
            ->count;
        $filtered = $total;
        if($search!=""){
            $filtered = Rank::select(DB::raw("count(rank.id) as count"))
                ->join("position","position.id","=","rank.position")
                ->where("rank.name","LIKE","%".$search."%")
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
        $Rank = new Rank();

        $Rank->name = $data->name;
        $Rank->position = $data->position;

        return $Rank->save();
    }

    public static function Put($data){
        $Rank = Rank::find($data['id']);

        if(array_key_exists("name",$data)){
            $Rank->name = $data['name'];
        }

        if(array_key_exists("position",$data)){
            $Rank->position = $data['position'];
        }

        return $Rank->update();
    }

    public static function select2($search=null){
        $data = Rank::select("rank.id","rank.name as text");

        if($search!=null){
            $data->where("rank.name","like","%$search%");
        }

        return $data
            ->limit(5)
            ->offset(0)
            ->get();
    }

    public static function Destroy($data){
        $Rank = Rank::findOrFail($data['id']);

        return $Rank->delete();
    }

    public static function getByPosition($position){
        return Rank::select(DB::raw("count(rank.id) as count"))->where("rank.position",$position)->first()->count;
    }
}
