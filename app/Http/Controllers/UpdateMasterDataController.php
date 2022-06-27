<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UpdateMasterDataController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if(auth()->user()->role!="Admin"){
            return redirect()->route("dashboard");
        }

        DB::select("ALTER TABLE users MODIFY COLUMN gender enum(". $this->str(config("data.gender")) .");");

        DB::select("ALTER TABLE major MODIFY COLUMN stage enum(". $this->str(config("data.stage")) .");");

        DB::select("ALTER TABLE teaching_history MODIFY COLUMN employment enum(". $this->str(config("data.status.employment")) .");");
        DB::select("ALTER TABLE teaching_history MODIFY COLUMN activity enum(". $this->str(config("data.status.activity")) .");");
        DB::select("ALTER TABLE teaching_history MODIFY COLUMN certification enum(". $this->str(config("data.status.certification")) .");");

        return redirect()->route("dashboard");
    }

    private function str($arr){
        $res = "";
        $length = count($arr)-1;
        foreach($arr as $k => $v){
            $res .= "'$v'";
            $res .= $length==$k ? "" : ",";
        }
        return $res;
    }
}
