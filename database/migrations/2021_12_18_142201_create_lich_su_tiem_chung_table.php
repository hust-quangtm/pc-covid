<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLichSuTiemChungTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lich_su_tiem_chung', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('vaccine_name'); //Tên vacxin
            $table->integer('ordinal_of_injection'); //mũi tiêm thứ?
            $table->timestamp('date_of_injection'); //Ngày tiêm
            $table->string('injection_address'); //Địa điểm tiêm
            $table->string('last_lot_vaccine_number'); //Số lô tiêm vacxin
            $table->string('note')->nullable(); //Phản ứng sau tiêm, ghi chú khác
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
        Schema::table('lich_su_tiem_chung', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::dropIfExists('lich_su_tiem_chung');
    }
}
