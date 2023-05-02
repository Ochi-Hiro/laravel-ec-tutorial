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
        Schema::create('primary_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('sort_order');
            $table->timestamps();
        });

        Schema::create('secondary_categories', function (Blueprint $table) { //upメソッド内で複数のSchemaを作る
            $table->id();
            $table->string('name');
            $table->integer('sort_order');
            $table->foreignId('primary_category_id')
            ->constrained(); //categoryの削除、更新はないのでcascadeは不要
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('secondary_categories'); //外部キー制約がかかっている為、必ず先にsecondaryを消す
        Schema::dropIfExists('primary_categories');
    }
};
