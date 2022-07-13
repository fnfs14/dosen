<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\College;


class CollegeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $isExist = function($name){ return College::where('name',$name)->first(); };

        $college = [
            "STMIK Bandung",
            "Institut Teknologi Bandung",
            "Universitas Islam Nusantara",
            "Universitas Widyatama",
            "Sekolah Tinggi Teknologi Indonesia Tanjung Pinang",
            "Universitas Pendidikan Indonesia",
            "Universitas Langlang Buana",
            "Institut Pertanian Bogor",
            "Universitas Islam Negeri Sunan Gunung Djati",
            "STMIK Likmi",
            "Universitas Indonesia",
        ];

        foreach($college as $k => $name){
            if($isExist($name)==null) College::insert([ 'name' => $name, ]);
        }
    }
}
