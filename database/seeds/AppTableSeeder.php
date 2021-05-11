<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AppTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('apptables')->truncate();
        Schema::enableForeignKeyConstraints();

        DB::table('apptables')->insert([
            ["title_en"=>"countries",'title'=>'الدول','is_active'=>1],
            ["title_en"=>"cities",'title'=>'المدن','is_active'=>1],
            ["title_en"=>"users",'title'=>'الأعضاء','is_active'=>1],
            ["title_en"=>"packages",'title'=>'الباقات','is_active'=>1],
            ["title_en"=>"settings",'title'=>'الإعدادات','is_active'=>1],
            ["title_en"=>"pages",'title'=>'الصفحات','is_active'=>1],
            ["title_en"=>"contacts",'title'=>'تواصل معنا','is_active'=>1],
            ["title_en"=>"notifications",'title'=>'الإشعارات','is_active'=>1],
            ["title_en"=>"permissions",'title'=>'الصلاحيات','is_active'=>1],
            ["title_en"=>"roles",'title'=>'الأدوار','is_active'=>1],
            ["title_en"=>"subscriptions",'title'=>'الإشتراكات','is_active'=>1],
            ["title_en"=>"chats",'title'=>'المحادثات','is_active'=>1],
            ["title_en"=>"deliveries",'title'=>'طلبات مندوب','is_active'=>1],
            ["title_en"=>"applications",'title'=>'طلبات الحاضنات','is_active'=>1],
            ["title_en"=>"apprates",'title'=>'التقييمات','is_active'=>1],
            ["title_en"=>"coupons",'title'=>'الكوبونات','is_active'=>1],
            ["title_en"=>"activations",'title'=>'مستخدمي الكوبونات','is_active'=>1],
            ["title_en"=>"withdrawals",'title'=>'طلبات السحب','is_active'=>1],
            ["title_en"=>"sliders",'title'=>'السلايدرات','is_active'=>1],
            ["title_en"=>"conditions",'title'=>'الشروط','is_active'=>1],
            ["title_en"=>"services",'title'=>'الخدمات','is_active'=>1],
            ["title_en"=>"seeks",'title'=>'طلبات الخدمات','is_active'=>1],
            ["title_en"=>"statuses",'title'=>'حالات الطلب','is_active'=>1],
            ["title_en"=>"orders",'title'=>'الطلبات','is_active'=>1],
            ["title_en"=>"staticpages",'title'=>'الصفحة الرئيسية','is_active'=>1],
        ]);

    }
}
