<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rank;
use App\Models\Level;

class ApiRankController extends Controller
{
    public function dt(Request $r) {
        $columns = [ "no", "name", ];

        $limit = $r->length;
        $start = $r->start;
        $order = $columns[$r->order['0']['column']];
        $dir = $r->order['0']['dir'];
        $search = $r->search['value'];

        $records = Rank::dt($search,$start,$limit,$order,$dir);
        $total = Rank::dtTotal($search);
        $data = [];

        if(!empty($records)) {
            $no = $start + 1;
            foreach($records as $k => $v){
                $data[] = [
                    "no" => $no,
                    "id" => $v->id,
                    "name" => $v->name,
                    "position" => $v->position,
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
            'position' => 'required|exists:App\Models\Position,id',
        ];
        $messages = [
            'name.required' => 'Nama Pangkat dibutuhkan',
            'name.max' => 'Nama Pangkat tidak boleh melebihi 255 karakter',
            'position.required' => 'Jabatan dibutuhkan',
            'position.exists' => 'Jabatan tidak tersedia',
        ];

        if($isEdit==true){
            $columns["id"] = "required";
            $messages["id.required"] = "Terjadi kesalahan";
        }

        $r->validate($columns, $messages);
    }

    public function store(Request $r){
        $this->validation($r);

        return response()->json(Rank::Store($r));
    }

    public function select2(Request $r){
        return response()->json(
            Rank::select2($r->search)
        );
    }

    public function update(Request $r){
        $this->validation($r, true);

        return response()->json(Rank::Put($r->all()));
    }

    public function destroy(Request $r){
        $Rank = Rank::findOrFail($r->id);

        $Level = Level::getByRank($Rank->id);
        if($Level>0){
            return response()->json("level");
        }

        return response()->json(Rank::Destroy($r->all()));
    }
}
