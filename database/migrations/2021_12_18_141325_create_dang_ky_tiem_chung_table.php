<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDangKyTiemChungTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dang_ky_tiem_chung', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->integer('ordinal_of_injection'); //mũi tiêm thứ?
            $table->timestamp('date_of_injection_register'); //ngày tiêm dự kiến
            $table->timestamp('date_of_injection')->nullable(); //ngày tiêm
            $table->string('part_of_injection_day'); //buổi tiêm dự kiến
            $table->string('priority_group'); //nhóm ưu tiên
            $table->string('injection_address')->nullable(); //địa điểm tiêm
            $table->string('status')->nullable()->default('Đang Xử Lý'); //Trạng thái của đăng ký tiêm
            $table->string('note')->nullable(); //ghi chú
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dang_ky_tiem_chung', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::dropIfExists('dang_ky_tiem_chung');
    }
}
