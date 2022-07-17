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
        $membersCollection = Member::factory(60000)->make();        
        $chunks = $membersCollection->chunk(500);
        foreach ($chunks as $chunk) {
            Member::insert($chunk->toArray());
        }

        $event = Event::factory(1)->create()->first();

        //give default event have initial lottery pool
        $members = Member::all();
        
        $modelChunks = $members->chunk(1000);        
        foreach ($modelChunks as $chunk) {
            $event->memberPool()->attach($chunk);
        }

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
