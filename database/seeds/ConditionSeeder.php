<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('conditions')->truncate();
        Schema::enableForeignKeyConstraints();
        
        DB::table('conditions')->insert([
            [ 'is_active'=>1,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            [ 'is_active'=>1,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            [ 'is_active'=>1,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            [ 'is_active'=>1,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            [ 'is_active'=>1,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
        ]);
        Schema::disableForeignKeyConstraints();
        DB::table('condition_translations')->truncate();
        Schema::enableForeignKeyConstraints();
        
        DB::table('condition_translations')->insert([
            ['condition_id'=>1,'title' => ' اتعهد انا من قام بتسجيل البيانات واتعهد ان اسلم واستلم الملاك الي ومن الحاضنة بنفسي','locale' => 'ar','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['condition_id'=>1,'title' => 'I pledge that I am the one who recorded the data, and I pledge to surrender and receive the angel to me and the incubator myself','locale' => 'en','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['condition_id'=>2,'title' => 'أتعهد الافصاح للحالة الصحية للطفل (حالة طبية او سلوكية خاصة) ','locale' => 'ar','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['condition_id'=>2,'title' => 'I pledge to disclose the child\'s health condition (special medical or behavioral condition)','locale' => 'en','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['condition_id'=>3,'title' => ' أتعهد أن طفلي لا يعاني او لم يتم تشخيصه سابقا بفرط الحركة','locale' => 'ar','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['condition_id'=>3,'title' => 'I pledge that my child does not have or has not previously been diagnosed with ADHD','locale' => 'en','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['condition_id'=>4,'title' => ' أتعهد أن طفلي لا يعاني من أي انواع من أمراض الحساسية ضد أي أكل أو روائح أو خلافه ','locale' => 'ar','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['condition_id'=>4,'title' => 'I pledge that my child does not suffer from any kind of allergies against any food, smells, etc.','locale' => 'en','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['condition_id'=>5,'title' => ' أتعهد أن أسلم وأستلم طفلي حسب الموعد والساعه والتاريخ التي قمت بحجزها ودفع قيمتها من خلال منصة ملاكي الصغير','locale' => 'ar','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['condition_id'=>5,'title' => 'I pledge to surrender and receive my child according to the date, time and date that I booked and paid for through the platform of my little angel','locale' => 'en','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
        ]);

    }
}
