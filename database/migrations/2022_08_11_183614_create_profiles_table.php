<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('current_living')->nullable();
            $table->integer('region_id')->nullable();
            $table->integer('distric_id')->nullable();
            $table->string('adults')->nullable();
            $table->string('childerns')->nullable();
            $table->string('house')->nullable();
            $table->string('budget')->nullable();
            $table->string('grage')->nullable();
            $table->string('sea_view')->nullable();
            $table->string('renovate')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_number')->nullable();
            $table->string('living_today')->nullable();
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
        Schema::dropIfExists('profiles');
    }
};
