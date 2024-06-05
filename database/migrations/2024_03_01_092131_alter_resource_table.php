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
        Schema::table('resources', function (Blueprint $table) {
            $table->integer('type_other_category_id')->unsigned()->after('category_id');
            $table->integer('crosscom_tematik_other_category_id')->unsigned()->after('type_other_category_id');

            $table->foreign('type_other_category_id')->references('id')->on('other_categories')->onDelete('cascade');
            $table->foreign('crosscom_tematik_other_category_id')->references('id')->on('other_categories')->onDelete('cascade');

            $table->dropForeign(['type_category_id']);
            $table->dropForeign(['crosscom_tematik_category_id']);
            $table->dropColumn('type_category_id');
            $table->dropColumn('crosscom_tematik_category_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('resources', function (Blueprint $table) {
            $table->dropForeign(['type_other_category_id']);
            $table->dropForeign(['crosscom_tematik_other_category_id']);
            $table->dropColumn('type_other_category_id');
            $table->dropColumn('crosscom_tematik_other_category_id');

            $table->integer('type_category_id')->unsigned();
            $table->integer('crosscom_tematik_category_id')->unsigned();

            $table->foreign('type_category_id')->references('id')->on('other_categories')->onDelete('cascade');
            $table->foreign('crosscom_tematik_category_id')->references('id')->on('other_categories')->onDelete('cascade');
        });
    }
};
