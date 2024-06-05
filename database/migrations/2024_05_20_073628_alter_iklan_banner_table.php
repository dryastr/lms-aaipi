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
        Schema::table('iklan_banner', function (Blueprint $table) {
            $table->dropColumn(['filename', 'size', 'ext']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('iklan_banner', function (Blueprint $table) {
            $table->string('filename');
            $table->integer('size');
            $table->string('ext');
        });
    }
};
