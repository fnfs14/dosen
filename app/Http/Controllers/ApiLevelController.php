<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Level;

class ApiLevelController extends Controller
{
    public function dt(Request $r) {
        $columns = [ "no", "level.name", "level.rate", "rank.name", ];

        $limit = $r->length;
        $start = $r->start;
        $order = $columns[$r->order['0']['column']];
        $dir = $r->order['0']['dir'];
        $search = $r->search['value'];

        $records = Level::dt($search,$start,$limit,$order,$dir);
        $total = Level::dtTotal($search);
        $data = [];

        if(!empty($records)) {
            $no = $start + 1;
            foreach($records as $k => $v){
                $data[] = [
                    "no" => $no,
                    "id" => $v->id,
                    "name" => $v->name,
                    "rate" => $v->rate,
                    "rank" => $v->rank,
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
            'rank' => 'required|exists:App\Models\Rank,id',
        ];
        $messages = [
            'name.required' => 'Nama Golongan dibutuhkan',
            'name.max' => 'Nama Golongan tidak boleh melebihi 255 karakter',
            'rank.required' => 'Pangkat dibutuhkan',
            'rank.exists' => 'Pangkat tidak tersedia',
        ];

        if($isEdit==true){
            $columns["id"] = "required";
            $messages["id.required"] = "Terjadi kesalahan";
        }

        $r->validate($columns, $messages);
    }

    public function store(Request $r){
        $this->validation($r);

        return response()->json(Level::Store($r));
    }

    public function update(Request $r){
        $this->validation($r, true);

        return response()->json(Level::Put($r->all()));
    }

    public function destroy(Request $r){
        return response()->json(Level::Destroy($r->all()));
    }
}
