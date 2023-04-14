<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mongodb')->create('feedback_questions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text("name");

            $table->bigInteger('feedback_question_group_id')->unsigned();
            $table->bigInteger('feedback_question_type_id')->unsigned();

            //Foreign keys
            $table->foreign('feedback_question_group_id')
                ->references('id')->on('feedback_groups')->onDelete('cascade');
            $table->foreign('feedback_question_type_id')
                ->references('id')->on('feedback_question_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mongodb')->dropIfExists('feedback_questions');
    }
};
