<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaseFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('case_feedback', function (Blueprint $table) {
            $table->id();
            $table->foreignId('case_id')->nullable()->constrained('user_cases')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('given_by')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->text('feedback')->nullable();
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
        Schema::dropIfExists('case_feedback');
    }
}
