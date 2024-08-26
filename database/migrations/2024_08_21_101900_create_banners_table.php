<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->id(); // Tạo trường khóa chính với tên 'id'
            $table->string('imagetype'); // Trường loại hình ảnh
            $table->string('url')->nullable(); // Cho phép giá trị NULL hoặc đặt giá trị mặc định
            $table->string('imageurl'); // Trường URL hình ảnh
            $table->timestamps(); // Thêm các trường created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banners');
    }
}
