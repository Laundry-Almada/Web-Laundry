<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('laundries', function (Blueprint $table) {
            $table->string('email')->after('phone');
        });
    }

    public function down()
    {
        Schema::table('laundries', function (Blueprint $table) {
            $table->dropColumn('email');
        });
    }
};
