<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public static function dt($search,$start,$limit,$order,$dir){
        $data = User::select("users.id","users.name");
        $data = $search=="" ? $data : $data->where("users.name","LIKE","%".$search."%");
        return $data
            ->where("users.role","Lecturer")
            ->limit($limit)
            ->offset($start)
            ->orderBy($order,$dir)
            ->get();
    }

    public static function dtTotal($search){
        $total = User::select(DB::raw("count(users.id) as count"))
            ->where("users.role","Lecturer")
            ->first()
            ->count;
        $filtered = $total;
        if($search!=""){
            $filtered = User::select(DB::raw("count(users.id) as count"))
                ->where("users.role","Lecturer")
                ->where("users.name","LIKE","%".$search."%")
                ->first()
                ->count;
        }
        return (object)[
            "total" => $total,
            "filtered" => $filtered,
        ];
    }

    public static function Store($data){
        $User = new User();

        $User->name = $data->name;
        $User->email = $data->email;
        $User->gender = $data->gender;
        $User->birth_place = $data->birth_place;
        $User->birth_date = $data->birth_date;
        $User->role = "Lecturer";
        $User->password = Hash::make('123');

        return $User->save();
    }
}
