<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CountrySeeder::class);
        $this->call(CitySeeder::class);
        $this->call(NationalitySeeder::class);
        $this->call(ApplicationSeeder::class);
        $this->call(DeliverySeeder::class);
        $this->call(TypeSeeder::class);
        $this->call(PackageSeeder::class);
        $this->call(LanguageSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(AppTableSeeder::class);
        $this->call(PermissionsSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(SubscriptionSeeder::class);
        $this->call(AdminPermissionsSeeder::class);
        $this->call(ContactSeeder::class);
        $this->call(PageSeeder::class);
        $this->call(SliderSeeder::class);
        $this->call(ConditionSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(StaticpageSeeder::class);
    }
}
