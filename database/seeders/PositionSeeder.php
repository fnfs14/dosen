<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Position;
use App\Models\Rank;
use App\Models\Level;


class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $positions = [
            "Guru Besar" => [
                "Pembina Utama Madya" => [
                    "Gol. IV/d" => 850,
                ],
                "Pembina Utama" => [
                    "Gol. IV/e" => 1050,
                ],
            ],
            "Lektor Kepala" => [
                "Pembina" => [
                    "Gol. IV/a" => 400,
                ],
                "Pembina Tk. I" => [
                    "Gol. IV/b" => 550,
                ],
                "Pembina Utama Muda" => [
                    "Gol. IV/c" => 700,
                ],
            ],
            "Lektor" => [
                "Penata" => [
                    "Gol. III/c" => 200,
                ],
                "Penata Tk. I" => [
                    "Gol. III/d" => 300,
                ],
            ],
            "Asisten Ahli" => [
                "Penata Muda" => [
                    "Gol. III/a" => 100,
                ],
                "Penata Muda Tk. I" => [
                    "Gol. III/b" => 150,
                ],
            ],
            "Tenaga Pengajar",
        ];

        foreach($positions as $position => $ranks){
            $isPositionExist = Position::where('name',$position)->first();
            $positionId = $isPositionExist==null
                ? Position::insertGetId([ 'name' => $position, ])
                : $isPositionExist->id;

            if(is_string($ranks)) continue;

            foreach($ranks as $rank => $levels){
                $isRankExist = Rank::where('name',$rank)->first();
                $rankId = $isRankExist==null
                    ? Rank::insertGetId([ 'name' => $rank, 'position' => $positionId, ])
                    : $isRankExist->id;

                if(is_string($levels)) continue;

                foreach($levels as $level => $rate){
                    $isLevelExist = Level::where('name',$level)->first();
                    $isLevelExist==null
                        ? Level::insertGetId([ 'name' => $level, 'rank' => $rankId, 'rate' => $rate, ])
                        : $isLevelExist->id;
                }
            }
        }
    }
}
