<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('subscriptions')->truncate();
        Schema::enableForeignKeyConstraints();

        DB::table('subscriptions')->insert([
            'user_id'           => 2,
            'package_id'        => 1,
            'price'             => 20,
            'units'             => 2,
        ]);

    }
}
