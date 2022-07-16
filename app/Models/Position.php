<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Position extends Model
{
    use HasFactory;
    protected $table = 'position';
    protected $guarded = ['id'];

    public static function dt($search,$start,$limit,$order,$dir){
        $data = Position::select("position.id","position.name");
        $data = $search=="" ? $data : $data->where("position.name","LIKE","%".$search."%");
        return $data
            ->limit($limit)
            ->offset($start)
            ->orderBy($order,$dir)
            ->get();
    }

    public static function dtTotal($search){
        $total = Position::select(DB::raw("count(position.id) as count"))
            ->first()
            ->count;
        $filtered = $total;
        if($search!=""){
            $filtered = Position::select(DB::raw("count(position.id) as count"))
                ->where("position.name","LIKE","%".$search."%")
                ->first()
                ->count;
        }
        return (object)[
            "total" => $total,
            "filtered" => $filtered,
        ];
    }

    public static function Store($data){
        $Position = new Position();

        $Position->name = $data->name;

        return $Position->save();
    }

    public static function select2($search=null,$id=null){
        $data = Position::select("position.id","position.name as text");

        if($search!=null)$data->where("position.name","like","%$search%");
        if($id!=null)$data->where("position.id",$id);

        return $data
            ->limit(5)
            ->offset(0)
            ->get();
    }

    public static function Put($data){
        $Position = Position::find($data['id']);

        if(array_key_exists("name",$data)){
            $Position->name = $data['name'];
        }

        return $Position->update();
    }

    public static function Destroy($data){
        $Position = Position::findOrFail($data['id']);

        return $Position->delete();
    }
}
