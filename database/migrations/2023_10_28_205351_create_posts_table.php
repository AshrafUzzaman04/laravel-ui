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
            $table->unsignedBigInteger("cat_id");
            $table->unsignedBigInteger("subcat_id");
            $table->unsignedBigInteger("user_id");
            $table->string("title");
            $table->string("slug");
            $table->string("post_image");
            $table->text("description");
            $table->timestamp("post_date")->useCurrent();
            $table->integer("status")->default(0);
            $table->string("tags")->nullable();
            $table->timestamps();
            $table->foreign("cat_id")->references("id")->on("categories")->onDelete("cascade");
            $table->foreign("subcat_id")->references("id")->on("sub_categories")->onDelete("cascade");
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
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
