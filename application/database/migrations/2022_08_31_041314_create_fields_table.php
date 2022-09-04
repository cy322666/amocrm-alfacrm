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
        Schema::create('alfacrm_fields', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->integer('account_id')->nullable();
            $table->integer('entity')->nullable();
            $table->string('name')->nullable();
            $table->string('code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alfacrm_fields');
    }
};
