<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('type');

            $table->uuid('service_id')->nullable()->after('laundry_id');

            $table->foreign('service_id')
                ->references('id')
                ->on('services')
                ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['service_id']);
            $table->dropColumn('service_id');

            $table->enum('type', ['express', 'regular', 'kiloan', 'satuan'])->after('laundry_id');
        });
    }
};
