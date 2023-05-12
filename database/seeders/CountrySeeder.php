<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('countries')->truncate();
        $countries = [
            ['name' => 'Абхазия'],
            ['name' => 'Азербайджан'],
            ['name' => 'Армения'],
            ['name' => 'Бахрейн'],
            ['name' => 'Беларусь'],
            ['name' => 'Венесуэла'],
            ['name' => 'Вьетнам'],
            ['name' => 'Египет'],
            ['name' => 'Израиль'],
            ['name' => 'Индия'],
            ['name' => 'Казахстан'],
            ['name' => 'Кипр'],
            ['name' => 'Киргизия'],
            ['name' => 'Куба'],
            ['name' => 'Маврикий'],
            ['name' => 'Мальдивы'],
            ['name' => 'ОАЭ'],
            ['name' => 'Россия'],
            ['name' => 'Сейшелы'],
            ['name' => 'Тайланд'],
            ['name' => 'Тунис'],
            ['name' => 'Турция'],
            ['name' => 'Узбекистан'],
            ['name' => 'Шри-Ланка'],
        ];
        DB::table('countries')->insert($countries);
    }
}
