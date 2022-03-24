<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class AddColumnViewer extends Migration
{
    public function up()
    {
        Schema::table('bizon_viewers', function(Blueprint $table) {
            $table->string('type')->nullable();
        });

//        Schema::table('user_settings', function(Blueprint $table) {
//            $table->boolean('is_private')->nullable();
//        });
    }
    
    public function down()
    {
    }
}

