<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genders = [
            ['title' => 'Мужской', 'value' => 'male'],
            ['title' => 'Женский', 'value' => 'female'],
        ];
        DB::table('genders')->insert($genders);
    }
}
