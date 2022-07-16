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

        $major = [
            [ "Teknik Informatika", "S1", "STMIK Bandung", "", "S.T", ],
            [ "Sistem Informasi", "S1", "STMIK Bandung", "", "S.Kom", ],
        ];

        foreach($major as $k => $v){
            $stage = $v[1];
            $name = $v[0];
            $college = $isExist($v[2],$stage,$name);
            if($college!=null){
                Major::insert([
                    'college' => $college,
                    'stage' => $stage,
                    'name' => $name,
                    'front_degree' => $v[3],
                    'back_degree' => $v[4],
                ]);
            }
        }
    }
}
