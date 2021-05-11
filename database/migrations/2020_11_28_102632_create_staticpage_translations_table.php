<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaticpageTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staticpage_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('staticpage_id');
            $table->foreign('staticpage_id')->references('id')->on('staticpages')->onUpdate('cascade')->onDelete('cascade');
            $table->string('locale')->index();
            $table->unique(['staticpage_id', 'locale']);
            $table->string('title');
            $table->string('slug');
            $table->string('excerpt')->nullable();
            $table->text('content')->nullable();
            $table->longText('images')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staticpage__translations');
    }
}
