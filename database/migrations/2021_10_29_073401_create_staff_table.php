<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string("stf_name");
            $table->string("stf_email");
            $table->string("stf_username")->unique();
            $table->string("stf_pass");
            $table->string("stf_phone");
            $table->string("stf_img")->default('profile-img.jpg');
            $table->timestamp("stf_age");
            $table->integer("stf_zip");
            $table->string("stf_city");
            $table->string("stf_block");
            $table->string("stf_district");
            $table->string("stf_region");
            $table->string("stf_state");
            $table->string("stf_contry");
            $table->text("stf_about");
            $table->string("stf_twitter");
            $table->string("stf_facebook");
            $table->string("stf_instagram");
            $table->string("stf_linkedin");
            $table->unsignedBigInteger('dept_id');
            $table->foreign('id')->references('id')->on('departments');
            $table->timestamp("created_at")->default(DB::raw("current_timestamp"));
            $table->timestamp("updated_at")->default(DB::raw("current_timestamp"));
            // $table->timestamps();            
            $table->string('status')->default('activate');
            $table->string('deleted_at')->default('No');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff');
    }
}
