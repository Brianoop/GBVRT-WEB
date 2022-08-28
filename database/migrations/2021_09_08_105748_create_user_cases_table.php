<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_cases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->nullable()->constrained('users')->onDelete('set null')->onUpdate('cascade');
          //  $table->foreignId('violences_id')->nullable()->constrained('violences')->onDelete('set null')->onUpdate('cascade');
          //  $table->foreignId('sub_counties_id')->nullable()->constrained('sub_counties')->onUpdate('cascade')->onDelete('set null');
            $table->enum('case_status', ['OPEN', 'CLOSED'])->default('CLOSED');
            $table->string('victim_name')->nullable();
            $table->string('victim_location')->nullable();
            $table->string('victim_contact')->nullable();
            $table->text('details')->nullable();
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
        Schema::dropIfExists('user_cases');
    }
}
