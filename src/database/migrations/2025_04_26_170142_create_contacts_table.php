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
        Schema::create('contacts', function (Blueprint $table) {
    $table->id();
    $table->string('name');          // お名前（姓+名）
    $table->tinyInteger('gender');   // 性別 (1:男性, 2:女性, 3:その他)
    $table->string('email');         // メールアドレス
    $table->string('tel');           // 電話番号
    $table->string('address');       // 住所
    $table->string('building_name')->nullable();  // 建物名（任意）
    $table->unsignedBigInteger('category_id');    // お問い合わせ種類
    $table->text('content');         // お問い合わせ内容
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
