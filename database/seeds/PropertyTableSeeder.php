<?php

use Illuminate\Database\Seeder;

class PropertyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('properties')->insert([
            'name' => 'Property 1',
            'landlord_id' => 1,
            'user_id' => 1
        ]);

        DB::table('properties')->insert([
            'name' => 'Property 2',
            'landlord_id' => 1,
            'user_id' => 1
        ]);

        DB::table('properties')->insert([
            'name' => 'Property 3',
            'landlord_id' => 2,
            'user_id' => 11
        ]);
    }
}
