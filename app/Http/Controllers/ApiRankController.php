<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rank;

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

    public function store(Request $r){
        $r->validate([
            'name' => 'required|max:255',
            'position' => 'required|exists:App\Models\Position,id',
        ], [
            'name.required' => 'Nama Pangkat dibutuhkan',
            'name.max' => 'Nama Pangkat tidak boleh melebihi 255 karakter',
            'position.required' => 'Jabatan dibutuhkan',
            'position.exists' => 'Jabatan tidak tersedia',
        ]);

        return response()->json(Rank::Store($r));
    }

    public function update(Request $r){
        $r->validate([
            'id' => 'required',
            'name' => 'required|max:255',
            'position' => 'required|exists:App\Models\Position,id',
        ], [
            'id.required' => 'Terjadi kesalahan',
            'name.required' => 'Nama Pangkat dibutuhkan',
            'name.max' => 'Nama Pangkat tidak boleh melebihi 255 karakter',
            'position.required' => 'Jabatan dibutuhkan',
            'position.exists' => 'Jabatan tidak tersedia',
        ]);

        return response()->json(Rank::Put($r->all()));
    }

    public function destroy(Request $r){
        return response()->json(Rank::Destroy($r->all()));
    }
}
