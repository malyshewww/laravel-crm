<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customers = [
            ['title' => 'Физическое лицо', 'type' => 'person'],
            ['title' => 'Юридическое лицо', 'type' => 'juridical'],
        ];
        DB::table('customers')->insert($customers);
    }
}
