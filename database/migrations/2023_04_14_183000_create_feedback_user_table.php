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
            $table->text('answer');
            $table->bigInteger('batch')->unsigned(); // Unique Batch ID for the feedback submission
            $table->bigInteger('feedback_question_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();


            //Foreign keys
            $table->foreign('feedback_question_id')
                ->references('id')->on('feedback_questions')->onDelete('cascade');

            //Foreign keys
            $table->foreign('user_id')
                ->references('id')->on('users')->onDelete('cascade');
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
