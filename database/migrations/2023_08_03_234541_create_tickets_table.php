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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket')->index();
            $table->unsignedBigInteger('people_id')->index();
            $table->foreign('people_id')->references('id')->on('people')->onDelete('cascade');
            $table->unsignedBigInteger('office_id')->index();
            $table->foreign('office_id')->references('id')->on('offices')->onDelete('cascade');
            $table->unsignedBigInteger('reason_id')->index();
            $table->foreign('reason_id')->references('id')->on('reasons')->onDelete('cascade');
            $table->unsignedBigInteger('finish_reason_id')->index()->nullable();
            $table->foreign('finish_reason_id')->references('id')->on('finish_reasons')->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('record',30)->index();
            $table->enum('status',['a','b','c','i'])->comment('a: Sin atenter,b: Atendiendo, c: Atendido, i: Anulado')->default('a');
            $table->text('comments');
            $table->datetime('attended')->nullable();
            $table->datetime('finished')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
