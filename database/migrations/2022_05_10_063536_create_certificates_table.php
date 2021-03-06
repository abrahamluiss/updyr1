<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('program');
            $table->string('faculty');
            $table->string('originality');
            $table->string('similitude');
            $table->string('date');
            // $table->string('code');
            $table->string('observation')->nullable();
             //author
             $table->unsignedBigInteger('author_id');
             $table->foreign('author_id')->references('id')->on('authors')->onDelete('cascade');

            //Adviser
            $table->unsignedBigInteger('adviser_id');
            $table->foreign('adviser_id')->references('id')->on('advisers')->onDelete('cascade');
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
        Schema::dropIfExists('certificates');
    }
}
