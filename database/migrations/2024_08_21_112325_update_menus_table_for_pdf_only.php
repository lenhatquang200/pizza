<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMenusTableForPdfOnly extends Migration
{
    public function up()
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->dropColumn('image_url');
            $table->string('pdf_path')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->string('image_url')->nullable();
            $table->string('pdf_path')->change();
        });
    }
}
