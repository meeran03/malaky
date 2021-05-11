<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('deliveries')->truncate();
        Schema::enableForeignKeyConstraints();

        DB::table('deliveries')->insert([
            [
                'name' => 'Ali',
                'phone' => 12345678904,
            ],
            [
                'name' => 'Ahmed',
                'phone' => 15935702552,
            ],
        ]);
    }
}
