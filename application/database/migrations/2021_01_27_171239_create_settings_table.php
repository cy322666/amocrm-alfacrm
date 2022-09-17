<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bizon_settings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('account_id')->nullable();
            $table->integer('pipeline_id')->nullable();

            $table->integer('status_id_cold')->nullable();
            $table->integer('status_id_soft')->nullable();
            $table->integer('status_id_hot')->nullable();

            $table->integer('time_cold')->nullable();
            $table->integer('time_soft')->nullable();
            $table->integer('time_hot')->nullable();

            $table->string('tag_cold')->nullable();
            $table->string('tag_soft')->nullable();
            $table->string('tag_hot')->nullable();
            $table->string('tag')->nullable();

            $table->string('staff_id_default')->nullable();
            $table->string('staff_id_cold')->nullable();
            $table->string('staff_id_soft')->nullable();
            $table->string('staff_id_hot')->nullable();

            $table->index('account_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
