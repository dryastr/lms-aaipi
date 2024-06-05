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
        Schema::table('certificates_templates', function (Blueprint $table) {
            $table->string('name_komite')->nullable()->after('status');
            $table->integer('nip_komite')->nullable()->after('name_komite');
            $table->string('tanda_tangan_komite')->nullable()->after('nip_komite');
            $table->boolean('is_komite')->nullable()->default(false)->after('tanda_tangan_komite');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
