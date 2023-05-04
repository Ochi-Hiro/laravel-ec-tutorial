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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('information');
            $table->unsignedInteger('price');
            $table->boolean('is_selling');
            $table->integer('sort_order')->nullable();
            $table->foreignId('shop_id')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('secondary_category_id')
            ->constrained(); //caregoryは消さないのでcascade不要
            $table->foreignId('image1')
            ->nullable()
            ->constrained('images');
            $table->foreignId('image2')
            ->nullable()
            ->constrained('images');
            $table->foreignId('image3')
            ->nullable()
            ->constrained('images');
            $table->foreignId('image4')
            ->nullable()
            ->constrained('images');
            //('~_id')だとlaravelでModelを推測してくれるが、違う場合は判別できない為constrainedの中で指定する。null許可はconstrainedの前に。
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
