<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('packages')->truncate();
        Schema::enableForeignKeyConstraints();

        DB::table('packages')->insert([
            ['type_id' => 1, 'units' => 10, 'price' => 100],
            ['type_id' => 1, 'units' => 20, 'price' => 200],
            ['type_id' => 1, 'units' => 500, 'price' => 500],
        ]);
        Schema::disableForeignKeyConstraints();
        DB::table('package_translations')->truncate();
        Schema::enableForeignKeyConstraints();

        DB::table('package_translations')->insert([
            ['package_id' => 1, 'locale' => 'ar', 'title' => 'باقة الساعات', 'feature_1' => 'ميزة الإشتراك 1', 'feature_2' => 'ميزة الإشتراك 2', 'feature_3' => 'ميزة الإشتراك 3', 'feature_4' => 'ميزة الإشتراك 4'],
            ['package_id' => 1, 'locale' => 'en', 'title' => 'Hours Package', 'feature_1' => 'Package Feature 1', 'feature_2' => 'Package Feature 2', 'feature_3' => 'Package Feature 3', 'feature_4' => 'Package Feature 4'],
            ['package_id' => 2, 'locale' => 'ar', 'title' => 'باقة اليوم', 'feature_1' => 'ميزة الإشتراك 1', 'feature_2' => 'ميزة الإشتراك 2', 'feature_3' => 'ميزة الإشتراك 3', 'feature_4' => 'ميزة الإشتراك 4'],
            ['package_id' => 2, 'locale' => 'en', 'title' => 'Day Package', 'feature_1' => 'Package Feature 1', 'feature_2' => 'Package Feature 2', 'feature_3' => 'Package Feature 3', 'feature_4' => 'Package Feature 4'],
            ['package_id' => 3, 'locale' => 'ar', 'title' => 'باقة الشهر', 'feature_1' => 'ميزة الإشتراك 1', 'feature_2' => 'ميزة الإشتراك 2', 'feature_3' => 'ميزة الإشتراك 3', 'feature_4' => 'ميزة الإشتراك 4'],
            ['package_id' => 3, 'locale' => 'en', 'title' => 'Month Package', 'feature_1' => 'Package Feature 1', 'feature_2' => 'Package Feature 2', 'feature_3' => 'Package Feature 3', 'feature_4' => 'Package Feature 4'],
        ]);
    }
}
