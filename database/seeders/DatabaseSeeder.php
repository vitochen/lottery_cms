<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Member;
use App\Models\Price;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->init();

        $this->call(MemberSeeder::class);
        $this->call(EventSeeder::class);
        $this->call(PriceSeeder::class);
    }

    private function init()
    {       
        DB::table('member_price_relation')->truncate();
        DB::table('member_event_relation')->truncate();
        Member::truncate();
        Event::truncate();
        Price::truncate();
    }
}
