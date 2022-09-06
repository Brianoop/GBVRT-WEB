<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsCreditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_credits', function (Blueprint $table) {
            $table->id();
            $table->string('sms_title')->nullable();
            $table->text('sms_message')->nullable();
            $table->string('sms_contact')->nullable();
            $table->foreignId('sent_to')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->text('details')->nullable();
            $table->string('message_id')->nullable();
            $table->string('sms_credit_balance')->nullable();
            $table->string('status_code')->nullable();
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
        Schema::dropIfExists('sms_credits');
    }
}
