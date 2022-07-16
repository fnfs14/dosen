<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Position;
use App\Models\Rank;

class ApiPositionController extends Controller
{
    public function dt(Request $r) {
        $columns = [ "no", "position.name", ];

        $limit = $r->length;
        $start = $r->start;
        $order = $columns[$r->order['0']['column']];
        $dir = $r->order['0']['dir'];
        $search = $r->search['value'];

        $records = Position::dt($search,$start,$limit,$order,$dir);
        $total = Position::dtTotal($search);
        $data = [];

        if(!empty($records)) {
            $no = $start + 1;
            foreach($records as $k => $v){
                $data[] = [
                    "no" => $no,
                    "name" => $v->name,
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
        $columns = [
            'name' => 'required|max:255',
        ];
        $messages = [
            'name.required' => 'Nama Jabatan Fungsional dibutuhkan',
            'name.max' => 'Nama Jabatan Fungsional tidak boleh melebihi 255 karakter',
        ];

        if($isEdit==true){
            $columns["id"] = "required";
            $messages["id.required"] = "Terjadi kesalahan";
        }

        $r->validate($columns, $messages);
    }

    public function store(Request $r){
        $this->validation($r);

        return response()->json(Position::Store($r));
    }

    public function select2(Request $r){
        return response()->json(
            Position::select2($r->search,$r->id)
        );
    }

    public function update(Request $r){
        $this->validation($r, true);

        return response()->json(Position::Put($r->all()));
    }

    public function destroy(Request $r){
        $Position = Position::findOrFail($r->id);

        $Rank = Rank::getByPosition($Position->id);
        if($Rank>0){
            return response()->json("rank");
        }

        return response()->json(Position::Destroy($r->all()));
    }
}
