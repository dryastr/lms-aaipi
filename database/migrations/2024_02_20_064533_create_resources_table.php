<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->string('title', 64);
            $table->string('seotitle')->nullable();
            $table->text('description')->nullable();
            $table->string('cover');
            $table->integer('category_id')->unsigned();
            $table->integer('type_category_id')->unsigned();
            $table->integer('crosscom_tematik_category_id')->unsigned();
            $table->string('source')->nullable();
            // $table->enum('source', ['all','course','category','meeting','product','bundle']);
            $table->string('filename');
            $table->integer('size');
            $table->string('ext');
            $table->timestamps();

            // Add foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('type_category_id')->references('id')->on('other_categories')->onDelete('cascade');
            $table->foreign('crosscom_tematik_category_id')->references('id')->on('other_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('resources');
    }
};
