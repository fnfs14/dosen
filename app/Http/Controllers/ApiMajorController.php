<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Major;

class ApiMajorController extends Controller
{
    public function dt(Request $r) {
        $columns = [ "no", "major.name", "college.name", "major.stage", "major.front_degree", "major.back_degree", ];

        $limit = $r->length;
        $start = $r->start;
        $order = $columns[$r->order['0']['column']];
        $dir = $r->order['0']['dir'];
        $search = $r->search['value'];

        $records = Major::dt($search,$start,$limit,$order,$dir);
        $total = Major::dtTotal($search);
        $data = [];

        if(!empty($records)) {
            $no = $start + 1;
            foreach($records as $k => $v){
                $data[] = [
                    "no" => $no,
                    "id" => $v->id,
                    "name" => $v->name,
                    "college" => $v->college,
                    "stage" => $v->stage,
                    "front_degree" => $v->front_degree,
                    "back_degree" => $v->back_degree,
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
        $columns = [
            'name' => 'required|max:255',
            'college' => 'required|exists:App\Models\College,id',
            'stage' => 'required',
        ];
        $messages = [
            'name.required' => 'Nama Program Studi dibutuhkan',
            'name.max' => 'Nama Program Studi tidak boleh melebihi 255 karakter',
            'college.required' => 'Perguruan Tinggi dibutuhkan',
            'college.exists' => 'Perguruan Tinggi tidak tersedia',
            'stage.required' => 'Jenjang dibutuhkan',
        ];

        if($isEdit==true){
            $columns["id"] = "required";
            $messages["id.required"] = "Terjadi kesalahan";
        }

        $r->validate($columns, $messages);
    }

    public function store(Request $r){
        $this->validation($r);

        return response()->json(Major::Store($r));
    }

    public function update(Request $r){
        $this->validation($r, true);

        return response()->json(Major::Put($r->all()));
    }

    public function destroy(Request $r){
        return response()->json(Major::Destroy($r->all()));
    }
}
