<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('identity')->nullable();
            $table->string('email')->nullable();
            $table->unsignedBigInteger('nationality_id')->nullable();
            $table->foreign('nationality_id')->references('id')->on('nationalities')->onUpdate('cascade')->onDelete('set null');
            $table->string('phone');
            $table->string('iban')->nullable();
            $table->string('address')->nullable();
            $table->tinyInteger('married')->default(0);
            $table->tinyInteger('has_childrens')->default(0);
            $table->integer('childrens')->default(0);
            $table->string('cv')->nullable();
            $table->string('infection')->nullable();
            $table->string('criminal')->nullable();
            $table->tinyInteger('is_active')->default(0);
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
        Schema::dropIfExists('applications');
    }
}
