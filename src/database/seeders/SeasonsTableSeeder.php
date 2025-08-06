<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeasonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seasonsDate = [
            "春",
            "夏",
            "秋",
            "冬",
        ];
        
        foreach ($seasonsDate as $season) {
            DB::table('seasons')->insert([
                'name' => $season,
            ]);
        }
    }
}
