<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaseMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('case_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_cases_id')->constrained('user_cases')->onUpdate('cascade')->onDelete('cascade');
            $table->enum('file_type', ['IMAGE', 'VIDEO']);
            $table->string('file_extension')->nullable();
            $table->string('file_path');
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
        Schema::dropIfExists('case_media');
    }
}
