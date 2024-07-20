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
            //
            $table->foreignId('fk_department')->constrained('departments')->after('phone_number');
            $table->foreignId('fk_designation')->constrained('designations')->after('fk_department');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropForeign(['fk_department']);
            $table->dropForeign(['fk_designation']);
            $table->dropColumn(['fk_department', 'fk_designation']);
        });
    }
};
