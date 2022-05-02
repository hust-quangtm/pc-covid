<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHealthTracksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('health_tracks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->timestamp('declaration_date');
            $table->string('session_of_day');
            $table->string('pulse');
            $table->string('daily_temperature');
            $table->string('breathing_rate');
            $table->string('spo2');
            $table->string('maximum_blood_pressure')->nullable();
            $table->string('minimum_blood_pressure')->nullable();
            $table->boolean('no_symptoms')->default(0); // khong trieu chung
            $table->boolean('tired')->default(0); // met moi
            $table->boolean('cough')->default(0); // ho
            $table->boolean('productive_cough')->default(0); // ho co dom
            $table->boolean('chills')->default(0); // on lanh
            $table->boolean('conjuntivitis')->default(0); // viem ket mac (do mat)
            $table->boolean('loss_of_taste_or_smell')->default(0);
            $table->boolean('diarrhea')->default(0); // tieu chay
            $table->boolean('hemoptisi')->default(0); // ho ra mau
            $table->boolean('difficulty_breathing')->default(0); // kho tho
            $table->boolean('chest_tightness')->default(0); // tuc nguc
            $table->boolean('not_awake')->default(0); // khong tinh tao
            $table->text('note')->nullable();
            $table->text('doctor_note')->nullable();

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('health_tracks', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::dropIfExists('health_tracks');
    }
}
