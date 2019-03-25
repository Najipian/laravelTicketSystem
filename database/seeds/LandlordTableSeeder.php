<?php

use Illuminate\Database\Seeder;

class LandlordTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('landlords')->insert([
            'id' => 1,
            'user_id' => 2,
        ]);

        DB::table('landlords')->insert([
            'id' => 2,
            'user_id' => 4,
            'parent_landlord_id' => 1
        ]);

        DB::table('landlords')->insert([
            'id' => 3,
            'user_id' => 6,
            'parent_landlord_id' => 1
        ]);

        DB::table('landlords')->insert([
            'id' => 4,
            'user_id' => 8,
            'parent_landlord_id' => 1
        ]);

        DB::table('landlords')->insert([
            'id' => 5,
            'user_id' => 10,
        ]);

        DB::table('landlords')->insert([
            'id' => 6,
            'user_id' => 12,
            'parent_landlord_id' => 5
        ]);

        DB::table('landlords')->insert([
            'id' => 7,
            'user_id' => 14,
            'parent_landlord_id' => 5
        ]);
    }
}
