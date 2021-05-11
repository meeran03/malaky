<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('applications')->truncate();
        Schema::enableForeignKeyConstraints();

        DB::table('applications')->insert([
            [
                'name' => 'Ali',
                'email' => 'ali@gmail.com',
                'nationality_id' => 194,
                'phone' => 12345678904,
            ],
            [
                'name' => 'Ahmed',
                'email' => 'ahmed@gmail.com',
                'nationality_id' => 194,
                'phone' => 15935702552,
            ],
        ]);
    }
}
