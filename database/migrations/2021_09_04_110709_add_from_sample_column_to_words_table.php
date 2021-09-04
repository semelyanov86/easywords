<?php

declare(strict_types=1);


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFromSampleColumnToWordsTable extends Migration
{
    public function up(): void
    {
        Schema::table('words', function (Blueprint $table) {
            $table->boolean('from_sample')->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('words', function (Blueprint $table) {
            $table->boolean('from_sample')->default(false);
        });
    }
}
