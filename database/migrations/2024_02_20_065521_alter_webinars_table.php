<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('webinars', function (Blueprint $table) {
            $table->integer('other_category_id')->unsigned()->nullable()->after('category_id');
            $table->enum('other_category_type', ['crosscom', 'type', 'thematic'])->nullable()->after('other_category_id');

            $table->foreign('other_category_id')->references('id')->on('other_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('webinars', function (Blueprint $table) {
            $table->dropForeign('webinars_other_category_id_foreign');
            $table->dropColumn(['other_category_id', 'other_category_type']);
        });
    }
};
