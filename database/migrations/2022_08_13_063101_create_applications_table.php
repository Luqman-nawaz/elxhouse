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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('region_id')->nullable();
            $table->string('distric_id')->nullable();
            $table->string('city_id')->nullable();
            $table->string('adults')->nullable();
            $table->string('childerns')->nullable();
            $table->string('house')->nullable();
            $table->string('budget')->nullable();
            $table->string('grage')->nullable();
            $table->string('sea_view')->nullable();
            $table->string('renovate')->nullable();
            $table->text('note')->nullable();
            $table->integer('approved')->default('0');
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
};
