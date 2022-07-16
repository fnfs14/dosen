<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Requirement;


class RequirementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $isExist = function($name){ return Requirement::where('name',$name)->first(); };

        $req = [
            "KTP",
            "KK",
            "NPWP",
        ];

        foreach($req as $k => $name){
            if($isExist($name)==null) Requirement::insert([ 'name' => $name, ]);
        }
    }
}
