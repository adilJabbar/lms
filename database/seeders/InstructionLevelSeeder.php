<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\InstructionLevel;

class InstructionLevelSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        for ($i = 1; $i < 5; $i++) {
            $data[$i]['level'] = $i;
        }
        InstructionLevel::insert($data);
    }

}
