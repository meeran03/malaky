<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('settings')->truncate();
        Schema::enableForeignKeyConstraints();
        
        DB::table('settings')->insert([
          'logo'=> 'https://via.placeholder.com/150',
          'copyrights' => 'All Rights Received 2020',
          'currency' => 'ريال',
          'currency_dollar' => '0.3',
          'address' => 'المملكة العربية السعودية',
          'phone' => '0123456789',
          'phone2' => '0123456789',
          'whatsapp' => '+009660123456789',
          'email'=> 'info@domain.com',
          'facebook' => 'https://www.facebook.com/',
          'twitter' => 'https://www.twitter.com/',
          'linkedin' => 'https://www.linkedin.com/',
          'instagram' => 'https://www.instagram.com/',
          'appstore' => '#',
          'googleplay' => '#',
        ]);
        Schema::disableForeignKeyConstraints();
        DB::table('setting_translations')->truncate();
        Schema::enableForeignKeyConstraints();
        
        DB::table('setting_translations')->insert([
          'title' => 'موقع ملاكي الصغير',
          'description' => 'وصف مختصر عن موقع التطبيق',
          'locale' => 'ar',
          'setting_id' => '1',
        ]);

        DB::table('setting_translations')->insert([
          'title' => 'Malaky',
          'description' => 'Small Description Here',
          'locale' => 'en',
          'setting_id' => '1',
        ]);
    }
}
