<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->foreignId('course_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('student_id')
                ->constrained()
                ->onDelete('cascade');
            $table->string('letter', 1);
            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->onDelete('set null');
            $table->timestamps();
            
            $table->primary(['course_id', 'student_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grades');
    }
}
