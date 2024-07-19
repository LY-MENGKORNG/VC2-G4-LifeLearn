<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
     public function up(): void
    {
        Schema::create('permission_students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->string('purpose');
            $table->date('start_date');
            $table->date('end_date');
            $table->softDeletes();
            $table->timestamps();

            // Assuming there's a 'frontusers' table
            $table->foreign('student_id')->references('id')->on('frontusers')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permission_students');
    }
};
