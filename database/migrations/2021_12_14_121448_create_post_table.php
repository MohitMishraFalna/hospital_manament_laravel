<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreatePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post', function (Blueprint $table) {
            $table->id();
            $table->string('post_title')->unique();
            $table->string('post_img');
            $table->longText('post');
            $table->string('status')->default('activate');
            $table->string('deleted_at')->default('No');
            $table->timestamp("created_at")->default(DB::raw("current_timestamp"));
            $table->timestamp("updated_at")->default(DB::raw("current_timestamp"));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post');
    }
}
