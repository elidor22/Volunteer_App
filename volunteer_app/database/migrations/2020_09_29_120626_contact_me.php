<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ContactMe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_mes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email');
            $table->string('phoneNumber');
            $table->string('name');
            $table->string('surname');
            $table->text('Feedback');
            $table->boolean('contactYou');
            $table->boolean('contacted');
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
        Schema::dropIfExists('contact_mes');
    }
}
