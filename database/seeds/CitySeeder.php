<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('cities')->truncate();
        Schema::enableForeignKeyConstraints();

        DB::table('cities')->insert([
           ['country_id' => 194,'title_ar' => 'تبوك' ,'title_en' => 'Tabuk' ],
           ['country_id' => 194,'title_ar' => 'الرياض' ,'title_en' => 'Riyadh' ],
           ['country_id' => 194,'title_ar' => 'الطائف' ,'title_en' => 'At Taif' ],
           ['country_id' => 194,'title_ar' => 'مكة المكرمة' ,'title_en' => 'Makkah Al Mukarramah' ],
           ['country_id' => 194,'title_ar' => 'حائل' ,'title_en' => 'Hail' ],
           ['country_id' => 194,'title_ar' => 'بريدة' ,'title_en' => 'Buraydah' ],
           ['country_id' => 194,'title_ar' => 'الهفوف' ,'title_en' => 'Al Hufuf' ],
           ['country_id' => 194,'title_ar' => 'الدمام' ,'title_en' => 'Ad Dammam' ],
           ['country_id' => 194,'title_ar' => 'المدينة المنورة' ,'title_en' => 'Al Madinah Al Munawwarah' ],
           ['country_id' => 194,'title_ar' => 'ابها' ,'title_en' => 'Abha' ],
           ['country_id' => 194,'title_ar' => 'جازان' ,'title_en' => 'Jazan' ],
           ['country_id' => 194,'title_ar' => 'جدة' ,'title_en' => 'Jeddah' ],
           ['country_id' => 194,'title_ar' => 'المجمعة' ,'title_en' => 'Al Majmaah' ],
           ['country_id' => 194,'title_ar' => 'الخبر' ,'title_en' => 'Al Khubar' ],
           ['country_id' => 194,'title_ar' => 'حفر الباطن' ,'title_en' => 'Hafar Al Batin' ],
           ['country_id' => 194,'title_ar' => 'خميس مشيط' ,'title_en' => 'Khamis Mushayt' ],
           ['country_id' => 194,'title_ar' => 'احد رفيده' ,'title_en' => 'Ahad Rifaydah' ],
           ['country_id' => 194,'title_ar' => 'القطيف' ,'title_en' => 'Al Qatif' ],
           ['country_id' => 194,'title_ar' => 'عنيزة' ,'title_en' => 'Unayzah' ],
           ['country_id' => 194,'title_ar' => 'قرية العليا' ,'title_en' => 'Qaryat Al Ulya' ],
           ['country_id' => 194,'title_ar' => 'الجبيل' ,'title_en' => 'Al Jubail' ],
           ['country_id' => 194,'title_ar' => 'النعيرية' ,'title_en' => 'An Nuayriyah' ],
           ['country_id' => 194,'title_ar' => 'الظهران' ,'title_en' => 'Dhahran' ],
           ['country_id' => 194,'title_ar' => 'الوجه' ,'title_en' => 'Al Wajh' ],
           ['country_id' => 194,'title_ar' => 'بقيق' ,'title_en' => 'Buqayq' ],
           ['country_id' => 194,'title_ar' => 'الزلفي' ,'title_en' => 'Az Zulfi' ],
           ['country_id' => 194,'title_ar' => 'خيبر' ,'title_en' => 'Khaybar' ],
           ['country_id' => 194,'title_ar' => 'الغاط' ,'title_en' => 'Al Ghat' ],
           ['country_id' => 194,'title_ar' => 'املج' ,'title_en' => 'Umluj' ],
           ['country_id' => 194,'title_ar' => 'رابغ' ,'title_en' => 'Rabigh' ],
           ['country_id' => 194,'title_ar' => 'عفيف' ,'title_en' => 'Afif' ],
           ['country_id' => 194,'title_ar' => 'ثادق' ,'title_en' => 'Thadiq' ],
           ['country_id' => 194,'title_ar' => 'سيهات' ,'title_en' => 'Sayhat' ],
           ['country_id' => 194,'title_ar' => 'تاروت' ,'title_en' => 'Tarut' ],
           ['country_id' => 194,'title_ar' => 'ينبع' ,'title_en' => 'Yanbu' ],
           ['country_id' => 194,'title_ar' => 'شقراء' ,'title_en' => 'Shaqra' ],
           ['country_id' => 194,'title_ar' => 'الدوادمي' ,'title_en' => 'Ad Duwadimi' ],
           ['country_id' => 194,'title_ar' => 'الدرعية' ,'title_en' => 'Ad Diriyah' ],
           ['country_id' => 194,'title_ar' => 'القويعية' ,'title_en' => 'Quwayiyah' ],
           ['country_id' => 194,'title_ar' => 'المزاحمية' ,'title_en' => 'Al Muzahimiyah' ],
           ['country_id' => 194,'title_ar' => 'بدر' ,'title_en' => 'Badr' ],
           ['country_id' => 194,'title_ar' => 'الخرج' ,'title_en' => 'Al Kharj' ],
           ['country_id' => 194,'title_ar' => 'الدلم' ,'title_en' => 'Ad Dilam' ],
           ['country_id' => 194,'title_ar' => 'الشنان' ,'title_en' => 'Ash Shinan' ],
           ['country_id' => 194,'title_ar' => 'الخرمة' ,'title_en' => 'Al Khurmah' ],
           ['country_id' => 194,'title_ar' => 'الجموم' ,'title_en' => 'Al Jumum' ],
           ['country_id' => 194,'title_ar' => 'المجاردة' ,'title_en' => 'Al Majardah' ],
           ['country_id' => 194,'title_ar' => 'السليل' ,'title_en' => 'As Sulayyil' ],
           ['country_id' => 194,'title_ar' => 'تثليث' ,'title_en' => 'Tathilith' ],
           ['country_id' => 194,'title_ar' => 'بيشة' ,'title_en' => 'Bishah' ],
           ['country_id' => 194,'title_ar' => 'الباحة' ,'title_en' => 'Al Baha' ],
           ['country_id' => 194,'title_ar' => 'القنفذة' ,'title_en' => 'Al Qunfidhah' ],
           ['country_id' => 194,'title_ar' => 'محايل' ,'title_en' => 'Muhayil' ],
           ['country_id' => 194,'title_ar' => 'ثول' ,'title_en' => 'Thuwal' ],
           ['country_id' => 194,'title_ar' => 'ضبا' ,'title_en' => 'Duba' ],
           ['country_id' => 194,'title_ar' => 'تربه' ,'title_en' => 'Turbah' ],
           ['country_id' => 194,'title_ar' => 'صفوى' ,'title_en' => 'Safwa' ],
           ['country_id' => 194,'title_ar' => 'عنك' ,'title_en' => 'Inak' ],
           ['country_id' => 194,'title_ar' => 'طريف' ,'title_en' => 'Turaif' ],
           ['country_id' => 194,'title_ar' => 'عرعر' ,'title_en' => 'Arar' ],
           ['country_id' => 194,'title_ar' => 'القريات' ,'title_en' => 'Al Qurayyat' ],
           ['country_id' => 194,'title_ar' => 'سكاكا' ,'title_en' => 'Sakaka' ],
           ['country_id' => 194,'title_ar' => 'رفحاء' ,'title_en' => 'Rafha' ],
           ['country_id' => 194,'title_ar' => 'دومة الجندل' ,'title_en' => 'Dawmat Al Jandal' ],
           ['country_id' => 194,'title_ar' => 'الرس' ,'title_en' => 'Ar Rass' ],
           ['country_id' => 194,'title_ar' => 'المذنب' ,'title_en' => 'Al Midhnab' ],
           ['country_id' => 194,'title_ar' => 'الخفجي' ,'title_en' => 'Al Khafji' ],
           ['country_id' => 194,'title_ar' => 'رياض الخبراء' ,'title_en' => 'Riyad Al Khabra' ],
           ['country_id' => 194,'title_ar' => 'البدائع' ,'title_en' => 'Al Badai' ],
           ['country_id' => 194,'title_ar' => 'رأس تنورة' ,'title_en' => 'Ras Tannurah' ],
           ['country_id' => 194,'title_ar' => 'البكيرية' ,'title_en' => 'Al Bukayriyah' ],
           ['country_id' => 194,'title_ar' => 'الشماسية' ,'title_en' => 'Ash Shimasiyah' ],
           ['country_id' => 194,'title_ar' => 'الحريق' ,'title_en' => 'Al Hariq' ],
           ['country_id' => 194,'title_ar' => 'حوطة بني تميم' ,'title_en' => 'Hawtat Bani Tamim' ],
           ['country_id' => 194,'title_ar' => 'ليلى' ,'title_en' => 'Layla' ],
           ['country_id' => 194,'title_ar' => 'بللسمر' ,'title_en' => 'Billasmar' ],
           ['country_id' => 194,'title_ar' => 'شرورة' ,'title_en' => 'Sharurah' ],
           ['country_id' => 194,'title_ar' => 'نجران' ,'title_en' => 'Najran' ],
           ['country_id' => 194,'title_ar' => 'صبيا' ,'title_en' => 'Sabya' ],
           ['country_id' => 194,'title_ar' => 'ابو عريش' ,'title_en' => 'Abu Arish' ],
           ['country_id' => 194,'title_ar' => 'صامطة' ,'title_en' => 'Samtah' ],
           ['country_id' => 194,'title_ar' => 'احد المسارحة' ,'title_en' => 'Ahad Al Musarihah' ],
           ['country_id' => 194,'title_ar' => 'مدينة الملك عبدالله الاقتصادية' ,'title_en' => 'King Abdullah Economic City' ],
        ]);
    }
}
