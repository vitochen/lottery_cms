<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Member;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $event = Event::factory(1)->create()->first();

        //give default event have initial lottery pool
        $members = Member::all();
        
        $modelChunks = $members->chunk(1000);        
        foreach ($modelChunks as $chunk) {
            $event->memberPool()->attach($chunk);
        }
    }
}
