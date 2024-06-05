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
        Schema::create('peta_propinsi', function (Blueprint $table) {
            $table->id();
            $table->string('mst_propinsi_id');
            $table->string('propinsi_name')->nullable();
            $table->integer('province_code');
            $table->longText('shape')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peta_propinsi');
    }
};
