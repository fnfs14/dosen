<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Requirement extends Model
{
    use HasFactory;
    protected $table = 'requirement';
    protected $guarded = ['id'];

    public static function dt($search,$start,$limit,$order,$dir){
        $data = Requirement::select("requirement.id","requirement.name");
        $data = $search=="" ? $data : $data->where("requirement.name","LIKE","%".$search."%");
        return $data
            ->limit($limit)
            ->offset($start)
            ->orderBy($order,$dir)
            ->get();
    }

    public static function dtTotal($search){
        $total = Requirement::select(DB::raw("count(requirement.id) as count"))
            ->first()
            ->count;
        $filtered = $total;
        if($search!=""){
            $filtered = Requirement::select(DB::raw("count(requirement.id) as count"))
                ->where("requirement.name","LIKE","%".$search."%")
                ->first()
                ->count;
        }
        return (object)[
            "total" => $total,
            "filtered" => $filtered,
        ];
    }

    public static function Store($data){
        $Requirement = new Requirement();

        $Requirement->name = $data->name;

        return $Requirement->save();
    }

    public static function select2($search=null){
        $data = Requirement::select("requirement.id","requirement.name as text");

        if($search!=null){
            $data->where("requirement.name","like","%$search%");
        }

        return $data
            ->limit(5)
            ->offset(0)
            ->get();
    }

    public static function Put($data){
        $Requirement = Requirement::find($data['id']);

        if(array_key_exists("name",$data)){
            $Requirement->name = $data['name'];
        }

        return $Requirement->update();
    }

    public static function Destroy($data){
        $Requirement = Requirement::findOrFail($data['id']);

        return $Requirement->delete();
    }
}
