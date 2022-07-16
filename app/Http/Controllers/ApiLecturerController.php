<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Promotion;
use Illuminate\Validation\Rule;

class ApiLecturerController extends Controller
{
    public function dt(Request $r) {
        $columns = [ "no", "users.name", "users.id", ];

        $limit = $r->length;
        $start = $r->start;
        $order = $columns[$r->order['0']['column']];
        $dir = $r->order['0']['dir'];
        $search = $r->search['value'];

        $records = User::dt($search,$start,$limit,$order,$dir);
        $total = User::dtTotal($search);
        $data = [];

        if(!empty($records)) {
            $no = $start + 1;
            foreach($records as $k => $v){
                $data[] = [
                    "no" => $no,
                    "name" => $v->name,
                    "id" => $v->id,
                    "promote" => Promotion::select("id")
                        ->where("user",$v->id)
                        ->where("status","Diajukan")
                        ->count(),
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
            'email' => 'required|email:filter|unique:users,email|max:255',
        ];
        $messages = [
            'name.required' => 'Nama Lengkap dibutuhkan',
            'name.max' => 'Nama Lengkap tidak boleh melebihi 255 karakter',
            'email.required' => 'Email dibutuhkan',
            'email.email' => 'Email harus alamat email',
            'email.unique' => 'Email sudah dipakai',
            'email.max' => 'Email tidak boleh melebihi 255 karakter',
        ];

        if($isEdit==true){
            $columns["id"] = "required";
            $columns["email"] = [
                'required',
                'max:255',
                'email:filter',
                Rule::unique('users')->where(fn ($query) => $query->where('id',"!=",$r->id)),
            ];
            $messages["id.required"] = "Terjadi kesalahan";
        }

        $r->validate($columns, $messages);
    }

    public function store(Request $r){
        $this->validation($r);

        return response()->json(User::Store($r));
    }

    public function update(Request $r){
        $this->validation($r,true);

        return response()->json(User::Put($r->all()));
    }
}
