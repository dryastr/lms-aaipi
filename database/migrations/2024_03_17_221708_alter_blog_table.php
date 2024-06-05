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
        Schema::table('blog', function (Blueprint $table) {
                $table->integer('facebook_shares')->unsigned()->default(0)->after('enable_comment');
                $table->integer('twitter_shares')->unsigned()->default(0)->after('facebook_shares');
                $table->integer('linkedin_shares')->unsigned()->default(0)->after('twitter_shares');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blog', function (Blueprint $table) {
            $table->dropColumn('facebook_shares');
            $table->dropColumn('twitter_shares');
            $table->dropColumn('linkedin_shares');
        });
    }
};
