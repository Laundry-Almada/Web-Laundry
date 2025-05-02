<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->string('username')->nullable()->unique()->after('phone');
            $table->dropUnique(['phone']);
            $table->string('phone')->nullable()->change();
            $table->unique('phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropUnique(['username']);
            $table->dropColumn('username');

            $table->dropUnique(['phone']);
            $table->string('phone')->nullable(false)->change();
            $table->unique('phone');
        });
    }
};
