<?php

use Illuminate\Database\Migrations\Migration;
use Jenssegers\Mongodb\Schema\Blueprint;
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
        Schema::connection('mongodb')->create('user_feedback', function (Blueprint $table) {
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
        Schema::connection('mongodb')->dropIfExists('user_feedback');
    }
};
