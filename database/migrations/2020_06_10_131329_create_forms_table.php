<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forms', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->longText('description')->nullable();

            $table->boolean('has_random_questions')->default(0);

            $table->boolean('accept_answers')->default(0);

            $table->foreignId('created_by');

            $table->foreign('created_by')
            ->on('users')
            ->references('id');

            $table->timestamps();

            $table->softDeletes();

            $table->index('created_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('forms');
    }
}
