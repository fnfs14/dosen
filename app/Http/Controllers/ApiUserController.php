<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ApiUserController extends Controller
{
    public function dt(Request $r) {
        $columns = [ "no", "name", ];

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
            'email' => 'required|email:filter|unique:users,email|max:255',
        ], [
            'name.required' => 'Nama Lengkap dibutuhkan',
            'name.max' => 'Nama Lengkap tidak boleh melebihi 255 karakter',
            'email.required' => 'Email dibutuhkan',
            'email.email' => 'Email harus alamat email',
            'email.unique' => 'Email sudah dipakai',
            'email.max' => 'Email tidak boleh melebihi 255 karakter',
        ]);

        return response()->json(User::Store($r));
    }
}
