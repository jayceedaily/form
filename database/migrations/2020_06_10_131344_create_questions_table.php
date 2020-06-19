<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('form_id');

            $table->foreign('form_id')->references('id')->on('forms');

            $table->string('content')->nullable();

            $table->longText('description')->nullable();

            $table->string('info')->nullable();

            $table->integer('order_number');

            $table->boolean('is_required')->default(1);

            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
