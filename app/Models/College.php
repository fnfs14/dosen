<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class College extends Model
{
    use HasFactory;
    protected $table = 'college';
    protected $guarded = ['id'];

    public static function dt($search,$start,$limit,$order,$dir){
        $data = College::select("college.id","college.name");
        $data = $search=="" ? $data : $data->where("college.name","LIKE","%".$search."%");
        return $data
            ->limit($limit)
            ->offset($start)
            ->orderBy($order,$dir)
            ->get();
    }

    public static function dtTotal($search){
        $total = College::select(DB::raw("count(college.id) as count"))
            ->first()
            ->count;
        $filtered = $total;
        if($search!=""){
            $filtered = College::select(DB::raw("count(college.id) as count"))
                ->where("college.name","LIKE","%".$search."%")
                ->first()
                ->count;
        }
        return (object)[
            "total" => $total,
            "filtered" => $filtered,
        ];
    }

    public static function Store($data){
        $College = new College();

        $College->name = $data->name;

        return $College->save();
    }

    public static function select2($search=null){
        $data = College::select("college.id","college.name as text");

        if($search!=null){
            $data->where("college.name","like","%$search%");
        }

        return $data
            ->limit(5)
            ->offset(0)
            ->get();
    }

    public static function Put($data){
        $College = College::find($data['id']);

        if(array_key_exists("name",$data)){
            $College->name = $data['name'];
        }

        return $College->update();
    }

    public static function Destroy($data){
        $College = College::findOrFail($data['id']);

        return $College->delete();
    }
}
