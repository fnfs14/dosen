<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Level extends Model
{
    use HasFactory;
    protected $table = 'level';
    protected $guarded = ['id'];

    public static function dt($search,$start,$limit,$order,$dir){
        $data = Level::select("level.id","level.name","level.rate","rank.name as rank")
            ->join("rank","rank.id","=","level.rank");
        if($search!=""){
            $data->where("level.name","LIKE","%".$search."%")
                ->orWhere("level.rate","LIKE","%".$search."%")
                ->orWhere("rank.name","LIKE","%".$search."%");
        }
        return $data
            ->limit($limit)
            ->offset($start)
            ->orderBy($order,$dir)
            ->get();
    }

    public static function dtTotal($search){
        $total = Level::select(DB::raw("count(level.id) as count"))
            ->first()
            ->count;
        $filtered = $total;
        if($search!=""){
            $filtered = Level::select(DB::raw("count(level.id) as count"))
                ->join("rank","rank.id","=","level.rank")
                ->where("level.name","LIKE","%".$search."%")
                ->orWhere("level.rate","LIKE","%".$search."%")
                ->orWhere("rank.name","LIKE","%".$search."%")
                ->first()
                ->count;
        }
        return (object)[
            "total" => $total,
            "filtered" => $filtered,
        ];
    }

    public static function Store($data){
        $Level = new Level();

        $Level->name = $data->name;
        $Level->rank = $data->rank;
        $Level->rate = $data->rate;

        return $Level->save();
    }

    public static function Put($data){
        $Level = Level::find($data['id']);

        if(array_key_exists("name",$data)){
            $Level->name = $data['name'];
        }

        if(array_key_exists("rank",$data)){
            $Level->rank = $data['rank'];
        }

        if(array_key_exists("rate",$data)){
            $Level->rate = $data['rate'];
        }

        return $Level->update();
    }

    public static function Destroy($data){
        $Level = Level::findOrFail($data['id']);

        return $Level->delete();
    }

    public static function getByRank($rank){
        return Level::select(DB::raw("count(level.id) as count"))->where("level.rank",$rank)->first()->count;
    }
}
