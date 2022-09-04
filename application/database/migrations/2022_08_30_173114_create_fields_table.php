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
        Schema::create('amocrm_fields', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->integer('entity')->nullable();
            $table->integer('account_id')->nullable();
            $table->integer("field_id")->nullable();
            $table->string("name")->nullable();
            $table->string("code")->nullable();
            $table->integer("field_type")->nullable();
            $table->integer("sort")->nullable();
            $table->boolean("is_multiple")->nullable();
            $table->boolean("is_system")->nullable();
            $table->boolean("is_editable")->nullable();
            $table->json("enums")->nullable();
            $table->string("values_tree")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('amocrm_fields');
    }
};
