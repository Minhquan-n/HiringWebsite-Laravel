<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tieude', 300);
            $table->string('vitrituyen', 300);
            $table->string('noilamviec', 300);
            $table->tinyInteger('soluong');
            $table->string('dotuoi', 100);
            $table->char('gioitinh', 10);
            $table->string('loaicongviec', 100);
            $table->char('mucluong', 50);
            $table->date('hannophoso');
            $table->date('ngaydangtin');
            $table->string('chitietcv', 5000);
            $table->string('yeucaucv', 5000);
            $table->string('quyenloi', 5000);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
