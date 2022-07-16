<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\College;
use App\Models\Major;

class ApiCollegeController extends Controller
{
    public function dt(Request $r) {
        $columns = [ "no", "college.name", ];

        $limit = $r->length;
        $start = $r->start;
        $order = $columns[$r->order['0']['column']];
        $dir = $r->order['0']['dir'];
        $search = $r->search['value'];

        $records = College::dt($search,$start,$limit,$order,$dir);
        $total = College::dtTotal($search);
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
            'name.required' => 'Nama Perguruan Tinggi dibutuhkan',
            'name.max' => 'Nama Perguruan Tinggi tidak boleh melebihi 255 karakter',
        ];

        if($isEdit==true){
            $columns["id"] = "required";
            $messages["id.required"] = "Terjadi kesalahan";
        }

        $r->validate($columns, $messages);
    }

    public function store(Request $r){
        $this->validation($r);

        return response()->json(College::Store($r));
    }

    public function select2(Request $r){
        return response()->json(
            College::select2($r->search,$r->id)
        );
    }

    public function update(Request $r){
        $this->validation($r, true);

        return response()->json(College::Put($r->all()));
    }

    public function destroy(Request $r){
        $College = College::findOrFail($r->id);

        $Major = Major::getByCollege($College->id);
        if($Major>0){
            return response()->json("major");
        }

        return response()->json(College::Destroy($r->all()));
    }
}
