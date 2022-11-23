<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectTimeTableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject_time_table', function (Blueprint $table) {
            $table->foreignId('time_table_id');
            $table->foreignId('subject_id');
            $table->enum('day', ['الأحد','الأثنين','الثلاثاء','الإربعاء','الخميس']);
            $table->enum('period', ['الاولى','الثانية','الثالثة','الرابعة','الخامسة','السادسة','السابعة']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subject_time_table');
    }
}
