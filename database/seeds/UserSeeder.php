<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('users')->truncate();
        Schema::enableForeignKeyConstraints();

        DB::table('users')->insert([
            [   'name'              => 'Administrator',
                'email'             => 'admin@test.com',
                'password'          => bcrypt('admin@13579'),
                'phone'             => '+2012345678',
                'country_id'        => 194,
                'city_id'           => 1,
                'birthday'          => Carbon::parse('1996-01-01'),
                'nationality_id'    => 1,
                'is_active'         => 1,
                'gender'            => 'male',
                'type_id'           => 3,
            ],
            [
                'name'              => 'malak',
                'email'             => 'malak@test.com',
                'password'          => bcrypt('malak@13579'),
                'phone'             => '+20123456789',
                'country_id'        => 194,
                'city_id'           => 1,
                'birthday'          => Carbon::parse('1996-01-01'),
                'nationality_id'    => 1,
                'is_active'         => 1,
                'gender'            => 'female',
                'type_id'           => 1,
            ],
            [
                'name'              => 'sitter',
                'email'             => 'sitter@test.com',
                'password'          => bcrypt('sitter@13579'),
                'phone'             => '+201234567890',
                'country_id'        => 194,
                'city_id'           => 1,
                'birthday'          => Carbon::parse('1996-01-01'),
                'nationality_id'    => 1,
                'is_active'         => 1,
                'gender'            => 'female',
                'type_id'           => 2,
            ]
            ]);
        $user = User::find(1);
        $user->assignRole('admin');

        $faker = \Faker\Factory::create();
        foreach (range(1,10) as $index) {
            DB::table('users')->insert([
                'name'                  => $faker->name,
                'email'                 => $faker->safeEmail,
                'password'              => bcrypt('secret'),
                'phone'                 => $faker->phoneNumber,
                'country_id'            => 194,
                'city_id'               => rand(1,83),
                'nationality_id'        => rand(1,247),
                'gender'                => $faker->randomElement(['male', 'female']),
                'type_id'               => rand(1,2),
            ]);
        }

//        addresses
        Schema::disableForeignKeyConstraints();
        DB::table('addresses')->truncate();
        Schema::enableForeignKeyConstraints();
        foreach (range(1,13) as $index) {
            DB::table('addresses')->insert([
                'user_id'               => $index,
                'lat'                  => $faker->latitude,
                'long'                 => $faker->longitude,
            ]);
        }

//        malaks
        Schema::disableForeignKeyConstraints();
        DB::table('childrens')->truncate();
        Schema::enableForeignKeyConstraints();

        DB::table('childrens')->insert([
            [   'user_id'        => 2,
                'title'          =>' محمد أحمد',
                'years'          => 1,
                'months'         => 1,
            ],
            [   'user_id'        => 2,
                'title'          =>' السيد أحمد',
                'years'          => 2,
                'months'         => 2,
            ],
            [   'user_id'        => 2,
                'title'          =>' فاطمة أحمد',
                'years'          => 3,
                'months'         => 3,
            ],
        ]);
//        malaz images
        Schema::disableForeignKeyConstraints();
        DB::table('images')->truncate();
        Schema::enableForeignKeyConstraints();

        DB::table('images')->insert([
            [   'user_id'        => 3,
                'url'          =>'https://via.placeholder.com/150',
            ],
            [   'user_id'        => 3,
                'url'          =>'https://via.placeholder.com/170',
            ]
        ]);
    }
}
