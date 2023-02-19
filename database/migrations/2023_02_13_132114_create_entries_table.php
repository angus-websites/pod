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
        Schema::connection('mongodb')->create('entries', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('title');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('template_id')->unsigned();

            //Foreign keys
            $table->foreign('user_id')
                ->references('id')->on('users')->onDelete('cascade');
            $table->foreign('template_id')
                ->references('id')->on('templates')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mongodb')->dropIfExists('entries');
    }
};
