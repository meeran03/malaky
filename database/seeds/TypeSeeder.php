<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('types')->truncate();
        Schema::enableForeignKeyConstraints();

        DB::table('types')->insert([
            [  'is_active'=>1,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            [  'is_active'=>1,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            [  'is_active'=>1,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
        ]);
        Schema::disableForeignKeyConstraints();
        DB::table('type_translations')->truncate();
        Schema::enableForeignKeyConstraints();

        DB::table('type_translations')->insert([
            ['type_id'=>1,'title' => 'ملاك','locale' => 'ar','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['type_id'=>1,'title' => 'Malak','locale' => 'en','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['type_id'=>2,'title' => 'ملاذ','locale' => 'ar','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['type_id'=>2,'title' => 'Sitter','locale' => 'en','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['type_id'=>3,'title' => 'إدارة','locale' => 'ar','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['type_id'=>3,'title' => 'Management','locale' => 'en','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
        ]);

    }
}
