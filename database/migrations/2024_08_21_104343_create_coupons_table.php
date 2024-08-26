<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id('id'); // Tạo trường khóa chính với tên 'couponsid'
            $table->string('couponcode')->unique(); // Trường mã giảm giá, phải là duy nhất
            $table->string('bannerurl'); // Trường URL hình ảnh
            $table->dateTime('validfrom'); // Ngày bắt đầu hiệu lực
            $table->dateTime('validto'); // Ngày kết thúc hiệu lực
            $table->dateTime('displayfrom'); // Ngày bắt đầu hiển thị
            $table->dateTime('displayto'); // Ngày kết thúc hiển thị
            $table->boolean('isfeatured')->default(false); // Cờ chỉ định nếu coupon là nổi bật
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
        Schema::dropIfExists('coupons');
    }
}
