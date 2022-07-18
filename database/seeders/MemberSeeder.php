<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $membersCollection = Member::factory(60000)->make();        
        $chunks = $membersCollection->chunk(500);
        foreach ($chunks as $chunk) {
            Member::insert($chunk->toArray());
        }
    }
}
