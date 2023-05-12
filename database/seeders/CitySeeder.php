<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('cities')->truncate();
        $cities = [
            ['name' => 'Москва'],
            ['name' => 'Казань'],
            ['name' => 'Нижний Новгород'],
            ['name' => 'Санкт-Петербург'],
            ['name' => 'Новосибирск'],
            ['name' => 'Ростов-на-Дону'],
            ['name' => 'Екатеринбург'],
            ['name' => 'Самара'],
            ['name' => 'Тюмень'],
            ['name' => 'Уфа'],
            ['name' => 'Абакан'],
            ['name' => 'Адлер'],
            ['name' => 'Актау'],
            ['name' => 'Актобе'],
            ['name' => 'Алматы'],
            ['name' => 'Алушта'],
            ['name' => 'Анадырь'],
            ['name' => 'Анапа'],
            ['name' => 'Армавир'],
            ['name' => 'Архангельск'],
            ['name' => 'Астрахань'],
            ['name' => 'Атырау'],
            ['name' => 'Ашхабад'],
            ['name' => 'Баку'],
            ['name' => 'Барабинск'],
            ['name' => 'Барнаул'],
            ['name' => 'Батуми'],
            ['name' => 'Белгород'],
            ['name' => 'Биробиджан'],
            ['name' => 'Бишкек'],
            ['name' => 'Благовещенск'],
            ['name' => 'Братск'],
            ['name' => 'Брест'],
            ['name' => 'Брянск'],
            ['name' => 'Бухара'],
            ['name' => 'Варшава'],
            ['name' => 'Великий Новгород'],
            ['name' => 'Великий Устюг'],
            ['name' => 'Вильнюс'],
            ['name' => 'Винница'],
            ['name' => 'Витебск'],
            ['name' => 'Владивосток'],
            ['name' => 'Владикавказ'],
            ['name' => 'Владимир'],
            ['name' => 'Волгоград'],
            ['name' => 'Вологда'],
            ['name' => 'Воркута'],
            ['name' => 'Воронеж'],
            ['name' => 'Гданьск'],
            ['name' => 'Геленджик'],
            ['name' => 'Гомель'],
            ['name' => 'Горно-Алтайск'],
            ['name' => 'Гродно'],
            ['name' => 'Грозный'],
            ['name' => 'Гюмри'],
            ['name' => 'Днепр'],
            ['name' => 'Донецк'],
            ['name' => 'Душанбе'],
            ['name' => 'Ереван'],
            ['name' => 'Ессентуки'],
            ['name' => 'Железноводск'],
            ['name' => 'Запорожье'],
            ['name' => 'Златоуст'],
            ['name' => 'Иваново'],
            ['name' => 'Ивано-Франковск'],
            ['name' => 'Ижевск'],
            ['name' => 'Иркутск'],
            ['name' => 'Йошкар-Ола'],
            ['name' => 'Калининград'],
            ['name' => 'Калуга'],
            ['name' => 'Карши'],
            ['name' => 'Каунас'],
            ['name' => 'Кемерово'],
            ['name' => 'Киев'],
            ['name' => 'Кировск'],
            ['name' => 'Кисловодск'],
            ['name' => 'Кишинев'],
            ['name' => 'Кокшетау'],
            ['name' => 'Костонай'],
            ['name' => 'Кострома'],
            ['name' => 'Краснодар'],
            ['name' => 'Красноярск'],
            ['name' => 'Кривой Рог'],
            ['name' => 'Курган'],
            ['name' => 'Курск'],
            ['name' => 'Кызыл'],
            ['name' => 'Кызылорда'],
            ['name' => 'Ликино-Дулево'],
            ['name' => 'Липецк'],
            ['name' => 'Луганск'],
            ['name' => 'Луцк'],
            ['name' => 'Львов'],
            ['name' => 'Магадан'],
            ['name' => 'Магнитогорск'],
            ['name' => 'Майкоп'],
            ['name' => 'Махачкала'],
            ['name' => 'Миасс'],
            ['name' => 'Минеральные Воды'],
            ['name' => 'Минск'],
            ['name' => 'Могилев'],
            ['name' => 'Мурманск'],
            ['name' => 'Набережные Челны'],
            ['name' => 'Навои'],
            ['name' => 'Назрань'],
            ['name' => 'Нальчик'],
            ['name' => 'Нарьян-Мар'],
            ['name' => 'Невинномысск'],
            ['name' => 'Нижневартовск'],
            ['name' => 'Нижнекамск'],
            ['name' => 'Нижний Тагил'],
            ['name' => 'Николаев'],
            ['name' => 'Новокузнецк'],
            ['name' => 'Новороссийск'],
            ['name' => 'Новый Уренгой'],
            ['name' => 'Норильск'],
            ['name' => 'Ноябрьск'],
            ['name' => 'Нур-Султан (Астана)'],
            ['name' => 'Одесса'],
            ['name' => 'Омск'],
            ['name' => 'Орел'],
            ['name' => 'Оренбург'],
            ['name' => 'Орехово-Зуево'],
            ['name' => 'Орск'],
            ['name' => 'Павлодар'],
            ['name' => 'Пенза'],
            ['name' => 'Пермь'],
            ['name' => 'Петрозаводск'],
            ['name' => 'Петропавловск'],
            ['name' => 'Петропавловск-Камчатский'],
            ['name' => 'Полтава'],
            ['name' => 'Псков'],
            ['name' => 'Пятигорск'],
            ['name' => 'Рига'],
            ['name' => 'Ровно'],
            ['name' => 'Ростов Великий'],
            ['name' => 'Рязань'],
            ['name' => 'Салехард'],
            ['name' => 'Самарканд'],
            ['name' => 'Саранск'],
            ['name' => 'Саратов'],
            ['name' => 'Севастополь'],
            ['name' => 'Семей'],
            ['name' => 'Симферополь'],
            ['name' => 'Смоленск'],
            ['name' => 'София'],
            ['name' => 'Сочи'],
            ['name' => 'Ставрополь'],
            ['name' => 'Сургут'],
            ['name' => 'Сызрань'],
            ['name' => 'Сыктывкар'],
            ['name' => 'Таганрог'],
            ['name' => 'Таллин'],
            ['name' => 'Тамбов'],
            ['name' => 'Тараз'],
            ['name' => 'Ташкент'],
            ['name' => 'Тбиллиси'],
            ['name' => 'Тверь'],
            ['name' => 'Термез'],
            ['name' => 'Тобольск'],
            ['name' => 'Тольятти'],
            ['name' => 'Томск'],
            ['name' => 'Трускавец'],
            ['name' => 'Туапсе'],
            ['name' => 'Тула'],
            ['name' => 'Ужгород'],
            ['name' => 'Улан-Удэ'],
            ['name' => 'Ульяновск'],
            ['name' => 'Уральск'],
            ['name' => 'Ургенч'],
            ['name' => 'Уренгой'],
            ['name' => 'Усинск'],
            ['name' => 'Ухта'],
            ['name' => 'Фергана'],
            ['name' => 'Хабаровск'],
            ['name' => 'Ханты-Мансийск'],
            ['name' => 'Харьков'],
            ['name' => 'Хельсинки'],
            ['name' => 'Херсон'],
            ['name' => 'Чебоксары'],
            ['name' => 'Череповец'],
            ['name' => 'Черновцы'],
            ['name' => 'Чита'],
            ['name' => 'Шымкент'],
            ['name' => 'Элиста'],
            ['name' => 'Южно-Сахалинск'],
            ['name' => 'Якутск'],
            ['name' => 'Ялта'],
            ['name' => 'Ярославль'],
        ];
        DB::table('cities')->insert($cities);
        // City::factory()->create();
    }
}
