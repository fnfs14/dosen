<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;

class PromotionRequirement extends Model
{
    use HasFactory;
    protected $table = 'promotion_requirement';
    protected $guarded = ['id'];

    public static function Data($id){
        $res = [];
        $data = PromotionRequirement::where("promotion",$id)->get();

        foreach($data as $k => $v){
            $res[$v->requirement] = $v->file;
        }

        return $res;
    }

    public static function Store($data){
        $ok = true;
        foreach($data->requirement as $k => $v){
            if($v!="undefined"){
                $PromotionRequirement = new PromotionRequirement();
                $PromotionRequirement->promotion = $data->id;
                $PromotionRequirement->requirement = $k;
                $PromotionRequirement->file = Storage::putFile('public', $data->file("requirement")[$k]);
                $save = $PromotionRequirement->save();

                $ok = (string)$save=="1" ? $ok : false;
            }
        }

        return $ok;
    }

    public static function Put($data){
        $ok = true;
        foreach($data->requirement as $k => $v){
            if($v!="undefined"){
                $save = PromotionRequirement::where("promotion",$data['id'])
                    ->where("requirement",$k)
                    ->update([
                        "file" => Storage::putFile('public', $data->file("requirement")[$k])
                    ]);

                $ok = (string)$save=="1" ? $ok : false;
            }
        }

        return $ok;
    }
}
