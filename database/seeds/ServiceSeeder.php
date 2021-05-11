<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('services')->truncate();
        Schema::enableForeignKeyConstraints();
        
        DB::table('services')->insert([
            [ 'is_active'=>1,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            [ 'is_active'=>1,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            [ 'is_active'=>1,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
        ]);
        Schema::disableForeignKeyConstraints();
        DB::table('service_translations')->truncate();
        Schema::enableForeignKeyConstraints();
        
        DB::table('service_translations')->insert([
            ['service_id'=>1,'title' => 'دور مسنين','locale' => 'ar','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['service_id'=>1,'title' => 'Nursing homes','locale' => 'en','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['service_id'=>2,'title' => 'ذوي الإحتياجات الخاصة','locale' => 'ar','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['service_id'=>2,'title' => 'People with special needs','locale' => 'en','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['service_id'=>3,'title' => 'ذوي الهمم','locale' => 'ar','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['service_id'=>3,'title' => 'People of determination','locale' => 'en','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
        ]);

    }
}
