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
    public function up(): void
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
    public function down(): void
    {
        Schema::dropIfExists('words');
    }
};
