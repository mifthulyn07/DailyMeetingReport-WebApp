<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->date('date')->nullable();
            $table->time('clockin')->nullable();
            $table->time('clockout')->nullable();
            $table->text('desc_clockin')->nullable();
            $table->text('desc_clockout')->nullable();
            $table->enum('status_clockin', ['present', 'absence'])->nullable();
            $table->enum('status_clockout', ['present', 'absence'])->nullable();
            $table->time('lateness_clockin')->nullable();
            $table->time('lateness_clockout')->nullable();
            $table->timestamps();

            // relationship
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendances');
    }
};
