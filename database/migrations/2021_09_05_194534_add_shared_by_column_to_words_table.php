<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSharedByColumnToWordsTable extends Migration
{
    public function up(): void
    {
        Schema::table('words', function (Blueprint $table) {
            $table->integer('shared_by')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('words', function (Blueprint $table) {
            $table->dropColumn('shared_by');
        });
    }
}
