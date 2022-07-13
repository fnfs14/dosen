<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pwd = Hash::make('123');
        $role = "Lecturer";
        $isExist = function($mail){ return User::where('email',$mail)->first(); };
        $setMail = function($name){ return substr(str_replace(" ","",strtolower($name)), 0, 10) . '@mail.com'; };

        $user = [
            "ABDURRAHMAN",
            "MURLINAH",
            "HARIS IRNAWAN",
            "URO ABDUROHIM",
            "HERNA GUNAWAN",
            "YUS JAYUSMAN",
            "LINDA APRIYANTI",
            "DEDY APRIADI",
            "SITI YULIYANTI",
            "MIRA SYLVIA KASEGRINA SIREGAR",
            "MEIDI FRANSISCA SIREGAR",
            "DANI PRADANA KARTAPUTRA",
            "AGUS SOEPRIADI",
            "MINA ISMU RAHAYU",
            "INDRA MAULANA YUSUP KUSUMAH",
            "RACHMAT JAENAL ABIDIN",
            "ERFIZAL FIKRI YUSMANSYAH",
            "FAIQUNISA",
        ];

        $name = "Admin";
        $mail = $setMail($name);
        if($isExist($mail)==null){
            User::insert([
                'name' => $name,
                'email' => $mail,
                'password' => $pwd,
                'role' => "Admin",
            ]);
        }

        foreach($user as $k => $name){
            $mail = $setMail($name);
            if($isExist($mail)==null){
                User::insert([
                    'name' => $name,
                    'email' => $mail,
                    'password' => $pwd,
                    'role' => $role,
                ]);
            }
        }
    }
}
