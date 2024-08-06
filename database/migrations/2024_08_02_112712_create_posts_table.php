<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title',50);
            $table->string('slug',50)->unique();
            $table->text('content');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('category_id');

            $table->string('thumbnail');
            $table->timestamp('published_at')->nullable();
            $table->enum('status',['published','draft']);
            $table->string('meta_title',50);
            $table->string('meta_description',50);
            $table->timestamps();
            $table->softDeletes();

            // // Tambahkan foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
