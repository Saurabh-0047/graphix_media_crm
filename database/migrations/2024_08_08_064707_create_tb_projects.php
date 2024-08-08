<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbProjects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_projects', function (Blueprint $table) {
            $table->id();
            $table->string('business_name');
            $table->string('client_name');
            $table->string('contact_no');
            $table->string('email_id');
            $table->string('address');
            $table->string('website');
            $table->string('packages');
            $table->longText('remarks');
            $table->string('sold_by_id');
            $table->string('sold_by_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_projects');
    }
}
