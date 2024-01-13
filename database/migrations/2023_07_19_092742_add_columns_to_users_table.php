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
        Schema::table('users', function (Blueprint $table) {
             // Add the 'phone' column after the 'name' column
             $table->string('phone')->after('name');
             // Add the 'confirm' column after the 'phone' column
             $table->string('confirm')->after('phone')->nullable();
             // Add the 'code' column after the 'confirm' column
             $table->string('code')->after('confirm')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phone');
            $table->dropColumn('confirm');
            $table->dropColumn('code');
        });
    }
};
