<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test', function (Blueprint $table) {
            $table->id();
            $table->string('test_name')->unique();
            $table->string('test_price');
            $table->string('test_range');
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
        Schema::dropIfExists('test');
    }
}
