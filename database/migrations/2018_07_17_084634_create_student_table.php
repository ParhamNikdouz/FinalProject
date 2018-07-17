<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name');
            $table->text('title_project');
            $table->integer('stu_number');
            $table->integer('master_id');
            $table->string('deadline')->nullable();
            $table->string('defence_time')->nullable();
            $table->string('class_number')->nullable();
            $table->integer('refree_id')->nullable();
            $table->string('defence_situation')->nullable();
            $table->string('complementary')->nullable();
            $table->integer('term_id')->nullable();
            $table->timestamps();
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
