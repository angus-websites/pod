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
            $table->text("question_type");

            $table->bigInteger('feedback_question_groups_id')->unsigned();

            //Foreign keys
            $table->foreign('feedback_question_groups_id')
                ->references('id')->on('feedback_groups')->onDelete('cascade');
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
