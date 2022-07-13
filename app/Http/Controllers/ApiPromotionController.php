<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promotion;
use App\Models\Major;
use Illuminate\Support\Facades\Storage;

class ApiPromotionController extends Controller
{
    public function dt(Request $r) {
        $columns = [ "no", "created_at", "time", "file", "status", "id", ];

        $limit = $r->length;
        $start = $r->start;
        $order = $columns[$r->order['0']['column']];
        $dir = $r->order['0']['dir'];
        $search = $r->search['value'];
        $user = $r->user;

        $records = Promotion::dt($user,$search,$start,$limit,$order,$dir);
        $total = Promotion::dtTotal($user,$search);
        $data = [];

        if(!empty($records)) {
            $no = $start + 1;
            foreach($records as $k => $v){
                $data[] = [
                    "no" => $no,
                    "file" => $v->file!=null
                        ? str_replace("public//","",asset("storage/app/".$v->file))
                        : "",
                    "time" => $v->time<0 || date("z",$v->time)=="0"
                        ? "Tepat Waktu"
                        : date("z",$v->time) ." Hari ",
                    "status" => $v->status,
                    "position" => $v->position,
                    "created_at" => date("Y-m-d",strtotime($v->created_at)),
                    "id" => $v->id,
                ];
                $no++;
            }
        }

        return response()->json([
            "draw" => intval($r->draw),
            "recordsTotal" => intval($total->total),
            "recordsFiltered" => intval($total->filtered),
            "data" => $data
        ]);
    }

    private function validation($r,$isEdit=false){
        $columns = [];
        $messages = [];

        if($isEdit==true){
            $columns["id"] = "required";
            $messages["id.required"] = "Terjadi kesalahan";
        }

        $r->validate($columns, $messages);
    }

    public function store(Request $r){
        $this->validation($r);

        return response()->json(Promotion::Store($r));
    }

    public function update(Request $r){
        $this->validation($r, true);

        return response()->json(Promotion::Put($r));
    }

    public function process(Request $r){
        return response()->json(Promotion::Process($r));
    }

    public function deny(Request $r){
        return response()->json(Promotion::Deny($r));
    }

    public function approve(Request $r){
        return response()->json(Promotion::Approve($r));
    }
}
