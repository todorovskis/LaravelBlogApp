<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->text('content');
            $table->integer('user_id');
            $table->integer('blog_id');
        });
    }

    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
//            $table->dropColumn('content');
        });
    }

};
