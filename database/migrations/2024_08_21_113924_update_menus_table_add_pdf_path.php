<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMenusTableAddPdfPath extends Migration
{
    public function up()
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->string('pdf_path')->nullable();
        });
    }

    public function down()
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->dropColumn('pdf_path');
        });
    }
}
