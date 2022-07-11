<?php

namespace Database\Seeders;

use App\Models\Price;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['event_id' => 1, 'name' => '十獎', 'quantity' => 10000],
            ['event_id' => 1, 'name' => '九獎', 'quantity' => 5000],
            ['event_id' => 1, 'name' => '八獎', 'quantity' => 2500],
            ['event_id' => 1, 'name' => '七獎', 'quantity' => 1300],
            ['event_id' => 1, 'name' => '六獎', 'quantity' => 650],
            ['event_id' => 1, 'name' => '五獎', 'quantity' => 300],
            ['event_id' => 1, 'name' => '四獎', 'quantity' => 150],
            ['event_id' => 1, 'name' => '三獎', 'quantity' => 50],
            ['event_id' => 1, 'name' => '二獎', 'quantity' => 10],
            ['event_id' => 1, 'name' => '一獎', 'quantity' => 3],
        ];

        Price::truncate();

        for ($i=0; $i < 10; $i++) { 
            Price::create($data[$i]);
        }
    }
}
