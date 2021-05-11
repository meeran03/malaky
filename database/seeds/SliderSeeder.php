<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('sliders')->truncate();
        Schema::enableForeignKeyConstraints();
        
        DB::table('sliders')->insert([
            [ 'is_active'=>1,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            [ 'is_active'=>1,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
        ]);
        Schema::disableForeignKeyConstraints();
        DB::table('slider_translations')->truncate();
        Schema::enableForeignKeyConstraints();
        
        DB::table('slider_translations')->insert([
            ['slider_id'=>1,'title' => 'الشروط والأحكام','excerpt' => 'وصف مختصر يكتب هنا','locale' => 'ar','slug'=>'الشروط-و-الأحكام','content'=>'المحتوي يكتب هنا','image' =>'https://via.placeholder.com/150','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['slider_id'=>1,'title' => 'Conditions and Rules','excerpt' => 'small description here','locale' => 'en','slug'=>'conditions-and-rules','content'=>'Content Write Here ','image' =>'https://via.placeholder.com/150','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['slider_id'=>2,'title' => 'نبذة عنا','excerpt' => 'وصف مختصر يكتب هنا','locale' => 'ar','slug'=>'نبذة-عنا','content'=>'المحتوي يكتب هنا','image' =>'https://via.placeholder.com/150','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['slider_id'=>2,'title' => 'About Us','excerpt' => 'small description here','locale' => 'en','slug'=>'about-us','content'=>'Content Write Here ','image' =>'https://via.placeholder.com/150','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
        ]);

    }
}
