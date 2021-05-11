<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class StaticpageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('staticpages')->truncate();
        Schema::enableForeignKeyConstraints();

        DB::table('staticpages')->insert([
            ['is_active' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['is_active' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['is_active' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['is_active' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['is_active' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
        Schema::disableForeignKeyConstraints();
        DB::table('staticpage_translations')->truncate();
        Schema::enableForeignKeyConstraints();

        DB::table('staticpage_translations')->insert([
            ['staticpage_id' => 1, 'title' => 'من نحن', 'excerpt' => 'وصف مختصر يكتب هنا', 'locale' => 'ar', 'slug' => 'من-نحن', 'content' => 'المحتوي يكتب هنا', 'images' => 'https://via.placeholder.com/150', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['staticpage_id' => 1, 'title' => 'WHO ARE WE', 'excerpt' => 'small description here', 'locale' => 'en', 'slug' => 'WHO-ARE-WE', 'content' => 'Content Written Here ', 'images' => 'https://via.placeholder.com/150', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['staticpage_id' => 2, 'title' => 'كيف يعمل', 'excerpt' => 'وصف مختصر يكتب هنا', 'locale' => 'ar', 'slug' => 'كيف-يعمل', 'content' => '<div class="col-md-4 col-sm-4 col-xs-12">
                <div class="item text-center">
                    <div class="icon-wrap">
                        <span class="step s1-1">1</span>
                        <span class="icon-tools-2"></span>
                    </div>
                        <h3>تسجيل فيديو</h3>
                        <p>سجل فيديو تعريفي عن أهم معلوماتك ومعبر عن امكانياتك</p>

                </div>
            </div>

            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="item text-center">
                    <div class="icon-wrap">
                        <span class="step s1-2">2</span>
                        <span class="icon-tools"></span>
                    </div>
                        <h3>تقدم للوظائف</h3>
                        <p>تقدم للوظائف المعروضة المناسبة وفقا لمهاراتك المدخلة مسبقا</p>
     
                </div>
            </div>

            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="item text-center">
                    <div class="icon-wrap">
                        <span class="step s1-3">3</span>
                        <span class="icon-layers"></span>
                    </div>
                        <h3>القبول بالوظيفة</h3>
                        <p>انتظر تواصل الشركات معك عبر الدردشة الخاصة بالتطبيق</p>
                  
                </div>
            </div>', 'images' => 'https://via.placeholder.com/150', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['staticpage_id' => 2, 'title' => 'HOW IT WORKS', 'excerpt' => 'small description here', 'locale' => 'en', 'slug' => 'HOW-IT-WORKS', 'content' => '<div class="col-md-4 col-sm-4 col-xs-12">
                <div class="item text-center">
                    <div class="icon-wrap">
                        <span class="step s1-1">1</span>
                        <span class="icon-tools-2"></span>
                    </div>
                        <h3>Record a video</h3>
                        <p>Record an introductory video about your most important information and express your capabilities</p>
                </div>
            </div>

            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="item text-center">
                    <div class="icon-wrap">
                        <span class="step s1-2">2</span>
                        <span class="icon-tools"></span>
                    </div>
                        <h3>Apply for jobs</h3>
                        <p>Apply to suitable job offerings according to your pre-entered skills</p>
                </div>
            </div>

            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="item text-center">
                    <div class="icon-wrap">
                        <span class="step s1-3">3</span>
                        <span class="icon-layers"></span>
                    </div>
                        <h3>Job acceptance</h3>
                        <p>Wait for companies to communicate with you via the chat app</p>
                </div>
            </div>', 'images' => 'https://via.placeholder.com/150', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['staticpage_id' => 3, 'title' => 'مميزاتنا', 'excerpt' => 'وصف مختصر يكتب هنا', 'locale' => 'ar', 'slug' => 'مميزاتنا', 'content' => 'المحتوي يكتب هنا', 'images' => 'https://via.placeholder.com/150', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['staticpage_id' => 3, 'title' => 'OUR ADVANTAGES', 'excerpt' => 'small description here', 'locale' => 'en', 'slug' => 'OUR-ADVANTAGES', 'content' => 'Content Written Here ', 'images' => 'https://via.placeholder.com/150', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['staticpage_id' => 4, 'title' => 'شاشات التطبيق', 'excerpt' => 'وصف مختصر يكتب هنا', 'locale' => 'ar', 'slug' => 'شاشات-التطبيق', 'content' => 'المحتوي يكتب هنا', 'images' => 'https://via.placeholder.com/150', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['staticpage_id' => 4, 'title' => 'SCREENSHOTS', 'excerpt' => 'small description here', 'locale' => 'en', 'slug' => 'SCREENSHOTS', 'content' => 'Content Written Here ', 'images' => 'https://via.placeholder.com/150', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['staticpage_id' => 5, 'title' => 'تواصل معنا', 'excerpt' => 'وصف مختصر يكتب هنا', 'locale' => 'ar', 'slug' => 'شاشات-التطبيق', 'content' => 'المحتوي يكتب هنا', 'images' => 'https://via.placeholder.com/150', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['staticpage_id' => 5, 'title' => 'Contact Us', 'excerpt' => 'small description here', 'locale' => 'en', 'slug' => 'SCREENSHOTS', 'content' => 'Content Written Here ', 'images' => 'https://via.placeholder.com/150', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
