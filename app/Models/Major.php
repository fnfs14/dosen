<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Major extends Model
{
    use HasFactory;
    protected $table = 'major';
    protected $guarded = ['id'];

    public static function dt($search,$start,$limit,$order,$dir){
        $data = Major::select("major.id","major.name","college.name as college","major.stage","major.front_degree","major.back_degree")
            ->join("college","college.id","=","major.college");
        if($search!=""){
            $data->where("major.name","LIKE","%".$search."%")
                ->orWhere("college.name","LIKE","%".$search."%")
                ->orWhere("major.stage","LIKE","%".$search."%")
                ->orWhere("major.front_degree","LIKE","%".$search."%")
                ->orWhere("major.back_degree","LIKE","%".$search."%");
        }
        return $data
            ->limit($limit)
            ->offset($start)
            ->orderBy($order,$dir)
            ->get();
    }

    public static function dtTotal($search){
        $total = Major::select(DB::raw("count(major.id) as count"))
            ->first()
            ->count;
        $filtered = $total;
        if($search!=""){
            $filtered = Major::select(DB::raw("count(major.id) as count"))
                ->join("college","college.id","=","major.college")
                ->where("major.name","LIKE","%".$search."%")
                ->orWhere("college.name","LIKE","%".$search."%")
                ->orWhere("major.stage","LIKE","%".$search."%")
                ->orWhere("major.front_degree","LIKE","%".$search."%")
                ->orWhere("major.back_degree","LIKE","%".$search."%")
                ->first()
                ->count;
        }
        return (object)[
            "total" => $total,
            "filtered" => $filtered,
        ];
    }

    public static function Store($data){
        $Major = new Major();

        $Major->name = $data->name;
        $Major->college = $data->college;
        $Major->stage = $data->stage;
        $Major->front_degree = $data->front_degree;
        $Major->back_degree = $data->back_degree;

        return $Major->save();
    }

    public static function Put($data){
        $Major = Major::find($data['id']);

        if(array_key_exists("name",$data)){
            $Major->name = $data['name'];
        }

        if(array_key_exists("college",$data)){
            $Major->college = $data['college'];
        }

        if(array_key_exists("stage",$data)){
            $Major->stage = $data['stage'];
        }

        if(array_key_exists("front_degree",$data)){
            $Major->front_degree = $data['front_degree'];
        }

        if(array_key_exists("back_degree",$data)){
            $Major->back_degree = $data['back_degree'];
        }

        return $Major->update();
    }

    public static function Destroy($data){
        $Major = Major::findOrFail($data['id']);

        return $Major->delete();
    }

    public static function getByCollege($college){
        return Major::select(DB::raw("count(major.id) as count"))->where("major.college",$college)->first()->count;
    }
}
