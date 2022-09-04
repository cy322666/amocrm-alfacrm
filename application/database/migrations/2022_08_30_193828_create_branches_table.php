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
        Schema::create('alfacrm_branches', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->integer('branch_id')->nullable();
            $table->integer('account_id')->nullable();
            $table->string('name')->nullable();
            $table->boolean('is_active')->nullable();
            $table->integer('weight')->nullable();
            $table->json('subject_ids')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alfacrm_branches');
    }
};
