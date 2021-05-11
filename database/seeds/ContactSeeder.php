<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('contacts')->truncate();
        Schema::enableForeignKeyConstraints();

        DB::table('contacts')->insert([
           [
               'user_id' => 2,
               'name' => 'مستخدم',
               'type' => 'contact',
               'phone' => '25563322',
               'message' => 'شكرا لك'
               ],
            [
                'user_id' => 3,
                'name' => 'مستخدم',
                'type' => 'complaint',
                'phone' => '25563322',
                'message' => 'شكوى سوء الخدمة'
            ],
        ]);
    }
}
