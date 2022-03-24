<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoggerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logger', function (Blueprint $table) {
            $table->id();
            $table->string('start')->nullable();
            $table->string('end')->nullable();
            $table->string('method')->nullable();
            $table->integer('code')->nullable();
            $table->string('url')->nullable();
            $table->string('error')->nullable();
            $table->json('body')->nullable();
            $table->json('response')->nullable();
            $table->integer('account_id')->nullable();
            
            $table->index('account_id');
            $table->index('error');
            $table->index('start');
            $table->index('code');
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logger');
    }
}
