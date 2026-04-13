<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('lendings', function (Blueprint $table) {
            if (! Schema::hasColumn('lendings', 'lend_date')) {
                $table->dateTime('lend_date')->nullable();
            }

            if (! Schema::hasColumn('lendings', 'return_date')) {
                $table->dateTime('return_date')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('lendings', function (Blueprint $table) {
            $table->dropColumn('lend_date');
        });
    }
};
