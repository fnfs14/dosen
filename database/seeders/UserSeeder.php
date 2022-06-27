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

        $name = "ABDURRAHMAN";
        $mail = $setMail($name);
        if($isExist($mail)==null){
            User::insert([
                'name' => $name,
                'email' => $mail,
                'password' => $pwd,
                'role' => $role,
            ]);
        }

        $name = "MURLINAH";
        $mail = $setMail($name);
        if($isExist($mail)==null){
            User::insert([
                'name' => $name,
                'email' => $mail,
                'password' => $pwd,
                'role' => $role,
            ]);
        }

        $name = "HARIS IRNAWAN";
        $mail = $setMail($name);
        if($isExist($mail)==null){
            User::insert([
                'name' => $name,
                'email' => $mail,
                'password' => $pwd,
                'role' => $role,
            ]);
        }

        $name = "URO ABDUROHIM";
        $mail = $setMail($name);
        if($isExist($mail)==null){
            User::insert([
                'name' => $name,
                'email' => $mail,
                'password' => $pwd,
                'role' => $role,
            ]);
        }

        $name = "HERNA GUNAWAN";
        $mail = $setMail($name);
        if($isExist($mail)==null){
            User::insert([
                'name' => $name,
                'email' => $mail,
                'password' => $pwd,
                'role' => $role,
            ]);
        }

        $name = "YUS JAYUSMAN";
        $mail = $setMail($name);
        if($isExist($mail)==null){
            User::insert([
                'name' => $name,
                'email' => $mail,
                'password' => $pwd,
                'role' => $role,
            ]);
        }

        $name = "LINDA APRIYANTI";
        $mail = $setMail($name);
        if($isExist($mail)==null){
            User::insert([
                'name' => $name,
                'email' => $mail,
                'password' => $pwd,
                'role' => $role,
            ]);
        }

        $name = "DEDY APRIADI";
        $mail = $setMail($name);
        if($isExist($mail)==null){
            User::insert([
                'name' => $name,
                'email' => $mail,
                'password' => $pwd,
                'role' => $role,
            ]);
        }

        $name = "SITI YULIYANTI";
        $mail = $setMail($name);
        if($isExist($mail)==null){
            User::insert([
                'name' => $name,
                'email' => $mail,
                'password' => $pwd,
                'role' => $role,
            ]);
        }

        $name = "MIRA SYLVIA KASEGRINA SIREGAR";
        $mail = $setMail($name);
        if($isExist($mail)==null){
            User::insert([
                'name' => $name,
                'email' => $mail,
                'password' => $pwd,
                'role' => $role,
            ]);
        }

        $name = "MEIDI FRANSISCA SIREGAR";
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
