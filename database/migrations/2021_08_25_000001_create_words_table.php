<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('words', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('original');
            $table->string('translated');
            $table->timestamp('done_at')->nullable();
            $table->boolean('starred')->default(false);
            $table->unsignedBigInteger('user_id');
            $table->string('language', 5);
            $table->bigInteger('views')->default(0);

            $table->index('language');

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
        Schema::dropIfExists('words');
    }
}
