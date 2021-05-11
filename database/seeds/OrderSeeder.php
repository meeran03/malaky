<?php

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('orders')->truncate();
        Schema::enableForeignKeyConstraints();

        $users = User::where('type_id', 2)->select('id')->get()->toArray();
        foreach (range(1,9) as $index) {
            $random_keys= array_rand($users,1);
            DB::table('orders')->insert([
                'user_id'          => 2,
                'receiver_id'      => $users[$random_keys]['id'],
                'units'            => 10,
//                'date'             => Carbon::now()->firstOfMonth()->addDays($index),
                'from'             => Carbon::now()->addDays($index),
                'to'               => Carbon::now()->addDays($index)->addHours(10),
                'status_id'        => $index,
            ]);
        }
    }
}
