<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('pages')->truncate();
        Schema::enableForeignKeyConstraints();

        DB::table('pages')->insert([
            [ 'image' =>'https://via.placeholder.com/150', 'is_active'=>1,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            [ 'image' =>'https://via.placeholder.com/150', 'is_active'=>1,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            [ 'image' =>'https://via.placeholder.com/150', 'is_active'=>1,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
        ]);
        Schema::disableForeignKeyConstraints();
        DB::table('page_translations')->truncate();
        Schema::enableForeignKeyConstraints();

        DB::table('page_translations')->insert([
            ['page_id'=>1,'title' => 'الشروط والأحكام','excerpt' => 'وصف مختصر يكتب هنا','locale' => 'ar','slug'=>'الشروط-و-الأحكام','content'=>'المحتوي يكتب هنا','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['page_id'=>1,'title' => 'Conditions and Rules','excerpt' => 'small description here','locale' => 'en','slug'=>'conditions-and-rules','content'=>'Content Write Here ','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['page_id'=>2,'title' => 'نبذة عنا','excerpt' => 'وصف مختصر يكتب هنا','locale' => 'ar','slug'=>'نبذة-عنا','content'=>'المحتوي يكتب هنا','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['page_id'=>2,'title' => 'About Us','excerpt' => 'small description here','locale' => 'en','slug'=>'about-us','content'=>'Content Write Here ','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['page_id'=>3,'title' => 'سياسة الخصوصية','excerpt' => 'وصف مختصر يكتب هنا','locale' => 'ar','slug'=>'سياسة-الخصوصية','content'=>'المحتوي يكتب هنا','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['page_id'=>3,'title' => 'Privacy policy','excerpt' => 'small description here','locale' => 'en','slug'=>'privacy-policy','content'=>'Content Write Here ','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
        ]);

    }
}
