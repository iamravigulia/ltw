<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLtwQuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fmt_ltw_ques', function (Blueprint $table) {
            $table->id();
            $table->string('word')->nullable();
            $table->foreignId('word_image_media_id')->nullable();
            $table->foreignId('word_audio_media_id')->nullable();
            $table->string('word_trans')->nullable();
            $table->string('word_meaning')->nullable();
            // $table->string('word')->nullable();

            $table->string('word_1')->nullable();
            $table->string('word_1_eng')->nullable();
            $table->string('word_1_eng_mean')->nullable();

            $table->string('word_2')->nullable();
            $table->string('word_2_eng')->nullable();
            $table->string('word_2_eng_mean')->nullable();

            $table->string('sentence')->nullable();
            $table->foreignId('sentence_audio_media_id')->nullable();

            $table->string('gender_1')->nullable();
            $table->string('gender_2')->nullable();
            $table->string('gender_3')->nullable();

            $table->string('r_word_1')->nullable();
            $table->string('r_word_2')->nullable();
            $table->string('r_word_3')->nullable();

            $table->tinyInteger('active')->default(1);
            $table->foreignId('difficulty_level_id')->nullable()->comment = 'id from difficulty_levels table';
            $table->string('format_title')->nullable();
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
        Schema::dropIfExists('fmt_ltw_ques');
    }
}
