<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeputiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deputies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name');
            $table->string('birthday')->nullable();
            $table->string('faction')->nullable();
            $table->string('work')->nullable();
            $table->unsignedInteger('district_id')->nullable();
            $table->unsignedInteger('region_id')->nullable();
            $table->text('details')->nullable();
            $table->text('url_report_2016')->nullable();
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
        Schema::dropIfExists('deputies');
    }
}
