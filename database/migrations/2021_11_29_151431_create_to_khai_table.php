<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToKhaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('to_khai', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('transportations'); //Phương tiện đi lại
            $table->string('transportations_identify')->nullable(); //Số hiệu phương tiện, định danh phương tiện.
            $table->string('departure_place'); //Nơi khởi hành
            $table->string('arrival_place'); //Nơi đến
            $table->timestamp('departure_date'); //Ngày khởi hành
            $table->boolean('pass_country')->default(0); //Lịch sử di chuyển
            $table->string('pass_country_note')->nullable();
            $table->boolean('has_signal')->default(0); //Dấu hiệu dịch tễ
            $table->string('signal_note')->nullable();
            $table->boolean('has_patient')->default(0); //Có tiếp xúc với người bệnh Covid không
            $table->boolean('has_from_sick_country')->default(0); //Có tiếp xúc với người từ vùng dịch không
            $table->boolean('has_sick')->default(0); // Có tiếp xúc với người có biểu hiện dịch tễ không
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
        Schema::table('to_khai', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::dropIfExists('to_khai');
    }
}
