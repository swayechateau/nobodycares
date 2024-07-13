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
            $table->id();
            $table->string('filename');
            $table->string('locale');
            $table->string('slug')->unique();
            $table->string('title');
            $table->boolean('featured');
            $table->text('excerpt');
            $table->string('hero_image');
            $table->string('category');
            $table->string('author');
            $table->text('content');
            $table->string('read_time');
            $table->timestamps();
        });

        DB::statement('CREATE VIRTUAL TABLE posts_fts USING fts5(title, content)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
        DB::statement('DROP TABLE IF EXISTS posts_fts');
    }
};
