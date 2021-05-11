<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('statuses')->truncate();
        Schema::enableForeignKeyConstraints();

        DB::table('statuses')->insert([
            ['is_active' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['is_active' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['is_active' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['is_active' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['is_active' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['is_active' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['is_active' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['is_active' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['is_active' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
        Schema::disableForeignKeyConstraints();
        DB::table('status_translations')->truncate();
        Schema::enableForeignKeyConstraints();

        DB::table('status_translations')->insert([
            ['status_id' => 1, 'title' => 'في إنتظار موافقة الحاضنة', 'locale' => 'ar', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['status_id' => 1, 'title' => 'Waiting for the babysitter\'s approval', 'locale' => 'en', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['status_id' => 2, 'title' => 'تم القبول من الحاضنة', 'locale' => 'ar', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['status_id' => 2, 'title' => 'Acceptance from the babysitter', 'locale' => 'en', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['status_id' => 3, 'title' => 'تم التأكيد من العميل', 'locale' => 'ar', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['status_id' => 3, 'title' => 'Confirmed by the customer', 'locale' => 'en', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['status_id' => 4, 'title' => 'تم إستلام الطفل', 'locale' => 'ar', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['status_id' => 4, 'title' => 'Child received', 'locale' => 'en', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['status_id' => 5, 'title' => 'تم إنتهاء المدة', 'locale' => 'ar', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['status_id' => 5, 'title' => 'Duration expired', 'locale' => 'en', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['status_id' => 6, 'title' => 'تم استلام الأم للطفل', 'locale' => 'ar', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['status_id' => 6, 'title' => 'Mother received the child', 'locale' => 'en', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['status_id' => 7, 'title' => 'تم الرفض من الحاضنة', 'locale' => 'ar', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['status_id' => 7, 'title' => 'It was rejected from the babysitter', 'locale' => 'en', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['status_id' => 8, 'title' => 'تم الإلغاء من العميل', 'locale' => 'ar', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['status_id' => 8, 'title' => 'Cancellation from client', 'locale' => 'en', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['status_id' => 9, 'title' => 'منتهي', 'locale' => 'ar', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['status_id' => 9, 'title' => 'Terminated', 'locale' => 'en', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
