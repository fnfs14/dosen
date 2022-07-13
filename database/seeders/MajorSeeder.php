<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Major;
use App\Models\College;


class MajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $isExist = function($college,$stage,$name){
            $college = College::where("name",$college)->first();
            $major = Major::where('college',$college->id)
                ->where('stage',$stage)
                ->where('name',$name)
                ->first();
            return $major==null ? $college->id : null;
        };

        $stage = "S1";
        $name = "Teknik Informatika";
        $college = $isExist("STMIK Bandung",$stage,$name);
        if($college!=null){
            Major::insert([
                'college' => $college,
                'stage' => $stage,
                'name' => $name,
                'front_degree' => "",
                'back_degree' => "S.T",
            ]);
        }

        $stage = "S2";
        $name = "Ilmu Komputer";
        $college = $isExist("STMIK Likmi",$stage,$name);
        if($college!=null){
            Major::insert([
                'college' => $college,
                'stage' => $stage,
                'name' => $name,
                'front_degree' => "",
                'back_degree' => "M.Kom",
            ]);
        }

        $stage = "S1";
        $name = "Sistem Informasi";
        $college = $isExist("STMIK Bandung",$stage,$name);
        if($college!=null){
            Major::insert([
                'college' => $college,
                'stage' => $stage,
                'name' => $name,
                'front_degree' => "",
                'back_degree' => "S.Kom",
            ]);
        }
    }
}
