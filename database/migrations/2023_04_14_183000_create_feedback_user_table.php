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
        Schema::connection('mongodb')->create('feedback_user', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('feedback_question_id')->unsigned();

            //Foreign keys
            $table->foreign('feedback_question_id')
                ->references('id')->on('feedback_questions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mongodb')->dropIfExists('feedback_user');
    }
};
