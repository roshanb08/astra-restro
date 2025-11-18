<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {

            // 1. Drop wrong FK if it exists (orders_customer_id_foreign pointing to user_id)
            try {
                DB::statement('ALTER TABLE orders DROP FOREIGN KEY orders_customer_id_foreign');
            } catch (\Exception $e) {
                // FK doesn't exist — ignore
            }

            // 2. Add customer_id column if not exists
            if (!Schema::hasColumn('orders', 'customer_id')) {
                $table->unsignedBigInteger('customer_id')->nullable()->after('user_id');
            }
        });

        Schema::table('orders', function (Blueprint $table) {
            // 3. Add correct FK
            $table->foreign('customer_id')
                ->references('id')
                ->on('customers')
                ->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {

            // Drop correct FK safely
            try {
                $table->dropForeign(['customer_id']);
            } catch (\Exception $e) {}

            // Remove the column if exists
            if (Schema::hasColumn('orders', 'customer_id')) {
                $table->dropColumn('customer_id');
            }
        });
    }
};
